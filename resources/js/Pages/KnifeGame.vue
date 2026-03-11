<template>
    <div class="container">
    <div class="miner-page">
        <!-- Active game banner -->
        <div v-if="activeGameBanner" class="miner-active-banner">
            <span>У вас есть незавершённая игра (ставка {{ activeGameBanner.bet | number }} ₽)</span>
            <div class="miner-active-banner__btns">
                <button class="miner-btn miner-btn--green" @click="resumeActiveGame">Продолжить</button>
                <button class="miner-btn miner-btn--gray" @click="forfeitGame">Отменить</button>
            </div>
        </div>

        <div class="miner-container">
            <div class="miner-panel miner-panel--left">
                <div class="miner-title">
                    <svg class="miner-title__icon" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M12 2L2 7v10l10 5 10-5V7L12 2z" fill="#5a6478"/>
                        <path d="M12 2v20l10-5V7l-10-5z" fill="#6b7689"/>
                    </svg>
                    <span>Miner</span>
                </div>

                <div class="miner-balance">
                    <svg class="miner-balance__icon" width="20" height="20" viewBox="0 0 24 24" fill="none">
                        <path d="M21 18V8a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2z" stroke="currentColor" stroke-width="2"/>
                        <path d="M12 12a3 3 0 1 0 0 6 3 3 0 0 0 0-6z" stroke="currentColor" stroke-width="2"/>
                    </svg>
                    <span class="miner-balance__value">{{ (userBalance || 0) | number }}</span>
                    <span class="miner-balance__label">₽ БАЛАНС</span>
                </div>

                <div class="miner-section">
                    <div class="miner-section__label">Количество мин</div>
                    <div class="miner-buttons miner-buttons--mines">
                        <button v-for="n in mineOptions" :key="n" class="miner-btn miner-btn--mine"
                            :class="{ 'miner-btn--active miner-btn--active-red': mineCount === n }"
                            @click="mineCount = n">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2L2 7v10l10 5 10-5V7L12 2z"/></svg>
                            {{ n }}
                        </button>
                    </div>
                </div>

                <div class="miner-section">
                    <div class="miner-section__label">Сумма ставки</div>
                    <div class="miner-bet-input-wrapper">
                        <div class="miner-bet-input" :class="{ 'miner-bet-input--focus': betInputFocused, 'miner-bet-input--max': betAmount === -1 }">
                            <span class="miner-bet-input__currency">₽</span>
                            <input v-model="customBet" type="text" inputmode="decimal" :placeholder="betAmount === -1 ? 'MAX' : '0.25'"
                                class="miner-bet-input__field" @focus="betInputFocused = true" @blur="betInputFocused = false; applyCustomBet()"
                                @keyup.enter="applyCustomBet" />
                        </div>
                        <div class="miner-buttons miner-buttons--bet">
                            <button v-for="opt in betOptions" :key="opt.label" class="miner-btn miner-btn--bet"
                                :class="{ 'miner-btn--active miner-btn--active-blue': isBetSelected(opt.value) }"
                                @click="setBet(opt.value)">
                                {{ opt.label }}
                            </button>
                        </div>
                    </div>
                </div>

                <button class="miner-play-btn" :disabled="!canStart" :class="{ 'miner-play-btn--disabled': !canStart }" @click="startGame">
                    Играть
                </button>
            </div>

            <div class="miner-panel miner-panel--center">
                <div class="miner-grid-wrapper" v-if="gameState !== 'idle'">
                    <div class="miner-grid" :class="{ 'miner-grid--disabled': gameState === 'ended' }">
                        <button v-for="(cell, index) in grid" :key="index" class="miner-cell"
                            :class="{
                                'miner-cell--revealed miner-cell--animate': cell.revealed,
                                'miner-cell--diamond': cell.revealed && !cell.hasMine,
                                'miner-cell--mine': cell.revealed && cell.hasMine,
                                'miner-cell--closed': !cell.revealed,
                            }"
                            :disabled="gameState === 'ended' || cell.revealed" @click="revealCell(index)">
                            <span v-if="!cell.revealed" class="miner-cell__arrow">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                                    <path d="M7 17L17 7M17 7H7M17 7v10" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                </svg>
                            </span>
                            <span v-else-if="cell.hasMine" class="miner-cell__mine-icon">
                                <svg width="36" height="36" viewBox="0 0 64 64" fill="none">
                                    <defs>
                                        <linearGradient id="mineGrad" x1="0%" y1="0%" x2="100%" y2="100%">
                                            <stop offset="0%" stop-color="#ff6b6b"/>
                                            <stop offset="50%" stop-color="#ee5a5a"/>
                                            <stop offset="100%" stop-color="#c0392b"/>
                                        </linearGradient>
                                        <filter id="mineGlow">
                                            <feGaussianBlur stdDeviation="2" result="blur"/>
                                            <feMerge><feMergeNode in="blur"/><feMergeNode in="SourceGraphic"/></feMerge>
                                        </filter>
                                    </defs>
                                    <circle cx="32" cy="32" r="24" fill="url(#mineGrad)" filter="url(#mineGlow)"/>
                                    <path d="M32 12l4 8 8 2-6 6 2 8-8-4-8 4 2-8-6-6 8-2 4-8z" fill="#fff" opacity="0.9"/>
                                </svg>
                            </span>
                            <span v-else class="miner-cell__diamond">
                                <svg width="32" height="32" viewBox="0 0 64 64" fill="none">
                                    <defs>
                                        <linearGradient id="diamondGrad" x1="0%" y1="0%" x2="100%" y2="100%">
                                            <stop offset="0%" stop-color="#7bed9f"/>
                                            <stop offset="50%" stop-color="#2ed573"/>
                                            <stop offset="100%" stop-color="#1dd1a1"/>
                                        </linearGradient>
                                        <filter id="diamondShine">
                                            <feGaussianBlur stdDeviation="1" result="blur"/>
                                            <feMerge><feMergeNode in="blur"/><feMergeNode in="SourceGraphic"/></feMerge>
                                        </filter>
                                    </defs>
                                    <path d="M32 4L8 24l24 36 24-36L32 4z" fill="url(#diamondGrad)" filter="url(#diamondShine)"/>
                                    <path d="M32 4v56M8 24l24 12 24-12M32 40L8 24l24-20 24 20-24 16z" stroke="#fff" stroke-width="1" opacity="0.4" fill="none"/>
                                </svg>
                            </span>
                        </button>
                    </div>
                </div>

                <div class="miner-idle-msg" v-else-if="!activeGameBanner">
                    <p>Выберите количество мин и ставку</p>
                    <p>Нажмите «Играть» чтобы начать</p>
                </div>

                <div class="miner-result" v-if="gameState === 'ended'">
                    <div class="miner-result__text" :class="gameResult.win ? 'miner-result--win' : 'miner-result--lose'">
                        {{ gameResult.win ? 'Победа!' : 'Мина!' }}
                    </div>
                    <div v-if="gameResult.win" class="miner-result__profit">+{{ gameResult.profit | number }} ₽</div>
                </div>
            </div>

            <div class="miner-panel miner-panel--right">
                <div class="miner-card miner-card--diamonds">
                    <div class="miner-card__title">Алмазы</div>
                    <div class="miner-card__desc">Открывай ячейки с кристаллами</div>
                    <div class="miner-card__badge miner-card__badge--green">{{ diamondsCount }}</div>
                    <div class="miner-card__icon miner-card__icon--crystal">◆</div>
                </div>
                <div class="miner-card miner-card--mines">
                    <div class="miner-card__title">Мины</div>
                    <div class="miner-card__desc">Количество мин на поле</div>
                    <div class="miner-card__badge miner-card__badge--red">{{ mineCount }}</div>
                    <div class="miner-card__icon miner-card__icon--mine">●</div>
                </div>

                <div class="miner-history">
                    <div class="miner-history__title">История игр</div>
                    <div class="miner-history__list">
                        <div v-for="g in gameHistory" :key="g.id" class="miner-history__item"
                            :class="g.win ? 'miner-history__item--win' : 'miner-history__item--lose'">
                            <div class="miner-history__row">
                                <span>{{ g.bet | number }} ₽</span>
                                <span :class="g.win ? 'color-green' : 'color-red'">{{ g.win ? '+' : '' }}{{ g.profit | number }} ₽</span>
                            </div>
                            <button v-if="!g.win && g.knife_indices" class="miner-history__view" @click="viewGameMines(g)">
                                Где были мины
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="miner-steps-wrapper" v-if="gameState === 'playing'">
            <div class="miner-steps">
                <div v-for="(step, idx) in multiplierSteps" :key="idx" class="miner-step"
                    :class="{ 'miner-step--passed': revealedCount >= idx, 'miner-step--current': revealedCount === idx }"
                    @click="cashoutAtStep(idx)">
                    <span class="miner-step__mult">x{{ step.mult.toFixed(2) }}</span>
                    <span class="miner-step__num">{{ idx }} {{ stepLabel(idx) }}</span>
                </div>
            </div>
        </div>

        <div class="miner-cashout-bar" v-if="gameState === 'playing'">
            <div class="miner-cashout-info">
                <span>Множитель: <strong>x{{ currentMultiplier.toFixed(2) }}</strong></span>
                <span>Выигрыш: <strong>{{ potentialWin | number }} ₽</strong></span>
            </div>
            <button class="miner-cashout-btn" :disabled="revealedCount < 1 || loading" @click="cashoutAtCurrent">
                Забрать {{ potentialWin | number }} ₽
            </button>
        </div>

        <!-- Modal: view mines -->
        <div v-if="historyViewGame" class="miner-modal" @click.self="historyViewGame = null">
            <div class="miner-modal__content">
                <div class="miner-modal__header">
                    <h3>Где были мины</h3>
                    <button class="miner-modal__close" @click="historyViewGame = null">×</button>
                </div>
                <div class="miner-modal__grid">
                    <div v-for="(c, i) in historyViewGrid" :key="i" class="miner-modal__cell"
                        :class="{ 'miner-modal__cell--mine': c.hasMine, 'miner-modal__cell--diamond': c.revealed && !c.hasMine, 'miner-modal__cell--clicked': c.clicked }">
                        <span v-if="c.hasMine" class="miner-cell__mine-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"><circle cx="12" cy="12" r="8" fill="#ef4444"/></svg>
                        </span>
                        <span v-else-if="c.clicked">✗</span>
                        <span v-else>◆</span>
                    </div>
                </div>
                <p class="miner-modal__hint">Красные — мины, ✗ — ваша последняя ячейка</p>
            </div>
        </div>
    </div>
    </div>
</template>

<script>
const GRID_SIZE = 25;
const MINE_OPTIONS = [3, 5, 10, 20];

export default {
    data() {
        return {
            gameState: 'idle',
            gameId: null,
            grid: [],
            mineCount: 3,
            mineOptions: MINE_OPTIONS,
            betAmount: 0.25,
            customBet: '0.25',
            betInputFocused: false,
            betOptions: [
                { value: 0.25, label: '₽0.25' },
                { value: 5, label: '₽5' },
                { value: 10, label: '₽10' },
                { value: -1, label: 'MAX' },
            ],
            currentMultiplier: 1,
            gameResult: { win: false, profit: 0 },
            loading: false,
            activeGameBanner: null,
            gameHistory: [],
            historyViewGame: null,
            historyViewGrid: [],
        };
    },
    computed: {
        userBalance() {
            const b = this.$root.user?.balance;
            return b != null ? parseFloat(b) : 0;
        },
        canStart() {
            const b = this.effectiveBet;
            return this.gameState === 'idle' && !this.loading && !this.activeGameBanner && b >= 0.25 && b <= this.userBalance && this.$root.isAuthorized;
        },
        effectiveBet() {
            if (this.betAmount === -1) return this.userBalance;
            const n = parseFloat(this.betAmount);
            return isNaN(n) ? 0.25 : Math.max(0.25, n);
        },
        safeCellsCount() { return GRID_SIZE - this.mineCount; },
        revealedCount() { return this.grid.filter(c => c.revealed && !c.hasMine).length; },
        diamondsCount() { return this.gameState === 'idle' ? this.safeCellsCount : this.revealedCount; },
        potentialWin() { return Math.round(this.effectiveBet * this.currentMultiplier * 100) / 100; },
        multiplierSteps() {
            const safe = this.safeCellsCount;
            const maxMult = { 3: 4, 5: 6, 10: 12, 20: 25 }[this.mineCount] || 4;
            const multPerStep = (maxMult - 1) / Math.max(safe, 1);
            const steps = [];
            for (let i = 0; i <= Math.min(safe, 12); i++) steps.push({ mult: 1 + i * multPerStep });
            return steps;
        },
    },
    watch: {
        '$root.user.balance'() { this.$forceUpdate(); },
    },
    mounted() {
        this.refreshUserBalance();
        this.checkActiveGame();
        this.loadHistory();
    },
    methods: {
        isBetSelected(val) {
            if (val === -1) return this.betAmount === -1;
            return Math.abs(this.betAmount - val) < 0.01;
        },
        setBet(val) {
            if (val === -1) { this.betAmount = -1; this.customBet = ''; }
            else { this.betAmount = val; this.customBet = String(val); }
        },
        applyCustomBet() {
            const s = String(this.customBet).trim().replace(',', '.');
            if (s.toLowerCase() === 'max' || s === '') {
                this.betAmount = -1;
                this.customBet = '';
                return;
            }
            const n = parseFloat(s);
            if (!isNaN(n) && n >= 0.25) {
                this.betAmount = n;
                this.customBet = String(n);
            } else {
                this.customBet = this.betAmount === -1 ? '' : String(this.betAmount);
            }
        },
        stepLabel(idx) {
            const n = idx % 100, d = n % 10;
            if (n >= 11 && n <= 14) return 'ШАГОВ';
            if (d === 1) return 'ШАГ';
            if (d >= 2 && d <= 4) return 'ШАГА';
            return 'ШАГОВ';
        },
        async refreshUserBalance() {
            if (this.$root.isAuthorized) await this.$root.getUser();
        },
        setBalance(val) {
            if (val == null || !this.$root.user) return;
            this.$root.$set(this.$root.user, 'balance', parseFloat(val));
        },
        async checkActiveGame() {
            try {
                const { data } = await this.axios.get('/knife-game/active');
                if (data.success && data.active) {
                    this.activeGameBanner = data.active;
                    this.setBalance(data.active.balance != null ? data.active.balance : data.balance);
                }
            } catch (e) { /* ignore */ }
        },
        resumeActiveGame() {
            if (!this.activeGameBanner) return;
            this.gameId = this.activeGameBanner.game_id;
            this.gameState = 'playing';
            this.currentMultiplier = 1;
            const revealed = this.activeGameBanner.revealed_indices || [];
            const revSet = new Set(revealed);
            this.grid = Array.from({ length: GRID_SIZE }, (_, i) => ({ revealed: revSet.has(i), hasMine: null }));
            this.activeGameBanner = null;
        },
        async forfeitGame() {
            try {
                const { data } = await this.axios.post('/knife-game/forfeit');
                if (data.success) {
                    this.activeGameBanner = null;
                    this.setBalance(data.balance);
                    this.$toast.info('Игра отменена');
                    this.refreshUserBalance();
                }
            } catch (e) {
                this.$toast.error('Ошибка');
            }
        },
        viewGameMines(g) {
            const knives = new Set(g.knife_indices || []);
            const revealed = g.revealed_indices || [];
            const lastClicked = revealed[revealed.length - 1];
            this.historyViewGrid = Array.from({ length: GRID_SIZE }, (_, i) => ({
                hasMine: knives.has(i),
                revealed: revealed.includes(i),
                clicked: i === lastClicked,
            }));
            this.historyViewGame = g;
        },
        async startGame() {
            if (!this.canStart) return;
            if (!this.$root.isAuthorized) return this.$toast.error('Войдите для игры');
            this.loading = true;
            try {
                const { data } = await this.axios.post('/knife-game/start', {
                    bet: this.effectiveBet,
                    knife_count: this.mineCount,
                });
                if (!data.success) return this.$toast.error(data.message || 'Ошибка');
                this.gameId = data.game_id;
                this.gameState = 'playing';
                this.currentMultiplier = 1;
                this.grid = Array.from({ length: GRID_SIZE }, () => ({ revealed: false, hasMine: null }));
                this.setBalance(data.balance);
                this.$root.playSound('upgrade-select-item2');
                this.refreshUserBalance();
            } catch (err) {
                this.$toast.error(err.response?.data?.message || 'Ошибка сети');
            } finally {
                this.loading = false;
            }
        },
        async revealCell(index) {
            if (this.gameState !== 'playing' || this.grid[index].revealed || this.loading || !this.gameId) return;
            this.loading = true;
            try {
                const { data } = await this.axios.post('/knife-game/reveal', { game_id: this.gameId, cell_index: index });
                if (!data.success) { this.$toast.error(data.message || 'Ошибка'); return; }
                this.grid[index].revealed = true;
                this.grid[index].hasMine = data.has_knife;
                this.currentMultiplier = data.multiplier ?? this.currentMultiplier;
                this.setBalance(data.balance);
                if (data.game_over) this.endGame(data.win, data.profit);
                else this.$root.playSound('upgrade-select-item2');
            } catch (err) {
                this.$toast.error(err.response?.data?.message || 'Ошибка сети');
            } finally {
                this.loading = false;
            }
        },
        cashoutAtStep(stepIndex) {
            const step = this.multiplierSteps[stepIndex];
            if (!step || this.revealedCount < stepIndex) return;
            this.cashout(step.mult);
        },
        async cashoutAtCurrent() { await this.cashout(this.currentMultiplier); },
        async cashout(mult) {
            if (!this.gameId || this.loading || mult <= 0 || mult > this.currentMultiplier) return;
            this.loading = true;
            try {
                const { data } = await this.axios.post('/knife-game/cashout', { game_id: this.gameId, multiplier: mult });
                if (!data.success) return this.$toast.error(data.message || 'Ошибка');
                this.setBalance(data.balance);
                this.endGame(true, data.profit);
            } catch (err) {
                this.$toast.error(err.response?.data?.message || 'Ошибка сети');
            } finally {
                this.loading = false;
            }
        },
        endGame(win, profit = 0) {
            this.gameState = 'ended';
            if (win) { this.gameResult = { win: true, profit }; this.$root.playSound('upgrade-success'); }
            else { this.gameResult = { win: false, profit: this.effectiveBet }; this.$root.playSound('upgrade-fail'); }
            this.loadHistory();
            this.$toast[win ? 'success' : 'error'](win ? `Победа! +${profit} ₽` : 'Мина! Вы проиграли.');
            setTimeout(() => {
                this.gameState = 'idle';
                this.gameResult = { win: false, profit: 0 };
                this.gameId = null;
                this.refreshUserBalance();
            }, 3000);
        },
        async loadHistory() {
            try {
                const { data } = await this.axios.get('/knife-game/history', { params: { limit: 15 } });
                if (data.success && data.history) this.gameHistory = data.history;
            } catch (e) {}
        },
    },
};
</script>

<style scoped>
.miner-page { min-height: 60vh; padding: 24px 0; }
.miner-container { display: grid; grid-template-columns: 280px 1fr 260px; gap: 24px; max-width: 1200px; margin: 0 auto; }
@media (max-width: 1024px) { .miner-container { grid-template-columns: 1fr; } }

.miner-active-banner {
    background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
    border-radius: 12px;
    padding: 16px 20px;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 12px;
}
.miner-active-banner__btns { display: flex; gap: 10px; }
.miner-btn--green { background: #22c55e !important; color: #fff !important; }
.miner-btn--gray { background: #475569 !important; color: #fff !important; }

.miner-panel {
    background: linear-gradient(145deg, #1a2234 0%, #151c2c 100%);
    border-radius: 16px;
    padding: 24px;
    border: 1px solid #2a3548;
}
.miner-panel--left { display: flex; flex-direction: column; gap: 24px; }
.miner-title { display: flex; align-items: center; gap: 10px; font-size: 22px; font-weight: 700; color: #fff; }
.miner-balance {
    display: flex; align-items: center; gap: 12px;
    background: linear-gradient(135deg, #22c55e 0%, #16a34a 100%);
    border-radius: 12px; padding: 14px 18px; color: #fff;
    box-shadow: 0 4px 12px rgba(34, 197, 94, 0.3);
}
.miner-balance__value { font-size: 24px; font-weight: 700; }
.miner-balance__label { font-size: 12px; opacity: 0.95; text-transform: uppercase; }

.miner-section__label { color: #e2e8f0; font-size: 14px; margin-bottom: 10px; }
.miner-buttons { display: flex; flex-wrap: wrap; gap: 8px; }
.miner-btn {
    display: flex; align-items: center; justify-content: center; gap: 6px;
    padding: 10px 16px; border-radius: 10px;
    background: #252f42; border: 1px solid #2a3548;
    color: #94a3b8; font-size: 14px; font-weight: 600; cursor: pointer;
    transition: all 0.25s ease;
}
.miner-btn:hover { background: #2d3a52; color: #e2e8f0; transform: translateY(-1px); }
.miner-btn--active { color: #fff; }
.miner-btn--active-red { background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%); border-color: #ef4444; }
.miner-btn--active-blue { background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); border-color: #3b82f6; }

.miner-bet-input-wrapper { margin-bottom: 12px; }
.miner-bet-input {
    display: flex; align-items: center; padding: 14px 18px;
    background: linear-gradient(145deg, #1e2838 0%, #252f42 100%);
    border: 2px solid #2a3548;
    border-radius: 14px;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}
.miner-bet-input:hover { border-color: #3b4958; }
.miner-bet-input--focus {
    border-color: #3b82f6;
    box-shadow: 0 0 0 3px rgba(59,130,246,0.25), inset 0 1px 0 rgba(255,255,255,0.05);
}
.miner-bet-input--max { border-color: #22c55e; box-shadow: 0 0 12px rgba(34,197,94,0.15); }
.miner-bet-input__currency {
    color: #64748b; font-weight: 700; margin-right: 10px;
    font-size: 20px; text-shadow: 0 1px 2px rgba(0,0,0,0.3);
}
.miner-bet-input__field {
    flex: 1; background: transparent; border: none;
    color: #fff; font-size: 20px; font-weight: 700;
    outline: none; letter-spacing: 0.5px;
}
.miner-bet-input__field::placeholder { color: #475569; opacity: 0.8; }

.miner-play-btn {
    margin-top: auto; padding: 14px 24px;
    background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
    border: none; border-radius: 12px; color: #fff;
    font-size: 16px; font-weight: 700; cursor: pointer;
    transition: all 0.25s; box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
}
.miner-play-btn:hover:not(:disabled) { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(59, 130, 246, 0.4); }
.miner-play-btn--disabled { opacity: 0.5; cursor: not-allowed; }

.miner-panel--center { display: flex; flex-direction: column; align-items: center; justify-content: center; }
.miner-grid-wrapper { padding: 20px 0; }
.miner-grid { display: grid; grid-template-columns: repeat(5, 1fr); gap: 10px; max-width: 320px; }
.miner-grid--disabled { pointer-events: none; }

.miner-cell {
    aspect-ratio: 1; min-width: 52px; min-height: 52px;
    background: linear-gradient(145deg, #252f42 0%, #1e2838 100%);
    border: 1px solid #2a3548; border-radius: 12px;
    display: flex; align-items: center; justify-content: center;
    cursor: pointer; transition: all 0.2s;
}
.miner-cell--closed:hover {
    background: linear-gradient(145deg, #2d3a52 0%, #252f42 100%);
    border-color: #3b82f6; transform: scale(1.03);
}
.miner-cell__arrow { color: #5a6b82; }
.miner-cell--revealed { animation: cellReveal 0.4s ease; }
@keyframes cellReveal {
    0% { transform: scale(1.2); opacity: 0.5; }
    100% { transform: scale(1); opacity: 1; }
}
.miner-cell--diamond {
    background: rgba(34, 197, 94, 0.25) !important;
    border-color: #22c55e !important;
    animation: diamondGlow 0.5s ease;
}
@keyframes diamondGlow {
    0% { box-shadow: 0 0 0 0 rgba(34, 197, 94, 0.5); }
    70% { box-shadow: 0 0 0 12px rgba(34, 197, 94, 0); }
    100% { box-shadow: none; }
}
.miner-cell--mine {
    background: rgba(239, 68, 68, 0.3) !important;
    border-color: #ef4444 !important;
    animation: mineExplode 0.5s ease;
}
@keyframes mineExplode {
    0% { transform: scale(0.8); opacity: 0; }
    50% { transform: scale(1.15); }
    100% { transform: scale(1); opacity: 1; }
}
.miner-cell__diamond { color: #22c55e; }
.miner-cell__mine-icon { display: flex; }

.miner-idle-msg { text-align: center; color: #64748b; font-size: 15px; padding: 40px 20px; }
.miner-result { text-align: center; padding: 16px; }
.miner-result__text { font-size: 24px; font-weight: 700; }
.miner-result--win { color: #22c55e; }
.miner-result--lose { color: #ef4444; animation: pulse 0.5s ease; }
@keyframes pulse { 0%,100% { transform: scale(1); } 50% { transform: scale(1.05); } }
.miner-result__profit { color: #22c55e; font-size: 20px; font-weight: 600; margin-top: 8px; }

.miner-panel--right { display: flex; flex-direction: column; gap: 20px; }
.miner-card {
    background: linear-gradient(145deg, #1e2838 0%, #1a2234 100%);
    border-radius: 14px; padding: 20px; border: 1px solid #2a3548;
    position: relative; overflow: hidden;
}
.miner-card__title { color: #fff; font-size: 16px; font-weight: 600; margin-bottom: 4px; }
.miner-card__desc { color: #94a3b8; font-size: 12px; margin-bottom: 12px; }
.miner-card__badge { display: inline-block; padding: 4px 12px; border-radius: 8px; font-size: 18px; font-weight: 700; color: #fff; }
.miner-card__badge--green { background: linear-gradient(135deg, #22c55e 0%, #16a34a 100%); }
.miner-card__badge--red { background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%); }
.miner-card__icon { position: absolute; right: 10px; bottom: 10px; font-size: 40px; opacity: 0.25; }
.miner-card__icon--crystal { color: #22c55e; }
.miner-card__icon--mine { color: #ef4444; }

.miner-history { margin-top: 16px; }
.miner-history__title { color: #94a3b8; font-size: 13px; margin-bottom: 10px; }
.miner-history__list { display: flex; flex-direction: column; gap: 8px; max-height: 200px; overflow-y: auto; }
.miner-history__item {
    padding: 10px 12px; background: #1e2838; border-radius: 10px;
    border-left: 4px solid #64748b;
}
.miner-history__item--win { border-left-color: #22c55e; }
.miner-history__item--lose { border-left-color: #ef4444; }
.miner-history__row { display: flex; justify-content: space-between; font-size: 13px; }
.miner-history__view {
    margin-top: 6px; padding: 4px 8px; font-size: 11px;
    background: rgba(59, 130, 246, 0.2); color: #60a5fa;
    border: none; border-radius: 6px; cursor: pointer;
}
.miner-history__view:hover { background: rgba(59, 130, 246, 0.3); }
.color-green { color: #22c55e; }
.color-red { color: #ef4444; }

.miner-steps-wrapper { margin-top: 24px; padding: 12px 0; }
.miner-steps { display: flex; gap: 8px; overflow-x: auto; padding-bottom: 8px; max-width: 100%; }
.miner-step {
    flex-shrink: 0; padding: 10px 14px; background: #252f42; border-radius: 10px;
    border: 1px solid #2a3548; color: #64748b; font-size: 12px; cursor: pointer;
    display: flex; flex-direction: column; align-items: center; gap: 2px;
    transition: all 0.2s;
}
.miner-step:hover { border-color: #3b82f6; color: #94a3b8; }
.miner-step--passed { background: rgba(34, 197, 94, 0.15); border-color: #22c55e; color: #22c55e; }
.miner-step--current { background: rgba(59, 130, 246, 0.2); border-color: #3b82f6; color: #fff; }
.miner-step__mult { font-weight: 700; }

.miner-cashout-bar {
    display: flex; align-items: center; justify-content: center; gap: 24px;
    margin-top: 20px; padding: 16px;
    background: linear-gradient(145deg, #1a2234 0%, #151c2c 100%);
    border-radius: 12px; border: 1px solid #2a3548;
    max-width: 500px; margin-left: auto; margin-right: auto;
}
.miner-cashout-info { display: flex; gap: 20px; color: #94a3b8; font-size: 14px; }
.miner-cashout-info strong { color: #fff; }
.miner-cashout-btn {
    padding: 10px 20px;
    background: linear-gradient(135deg, #22c55e 0%, #16a34a 100%);
    border: none; border-radius: 10px; color: #fff; font-weight: 600;
    cursor: pointer; transition: all 0.2s;
}
.miner-cashout-btn:hover:not(:disabled) { transform: translateY(-1px); }
.miner-cashout-btn:disabled { opacity: 0.5; cursor: not-allowed; }

.miner-modal {
    position: fixed; inset: 0; background: rgba(0,0,0,0.7);
    display: flex; align-items: center; justify-content: center;
    z-index: 1000; padding: 20px;
}
.miner-modal__content {
    background: #1a2234; border-radius: 16px; padding: 24px;
    border: 1px solid #2a3548; max-width: 400px; width: 100%;
}
.miner-modal__header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px; }
.miner-modal__header h3 { color: #fff; margin: 0; font-size: 18px; }
.miner-modal__close { background: none; border: none; color: #94a3b8; font-size: 28px; cursor: pointer; }
.miner-modal__grid {
    display: grid; grid-template-columns: repeat(5, 1fr); gap: 6px;
}
.miner-modal__cell {
    aspect-ratio: 1; background: #252f42; border-radius: 8px;
    display: flex; align-items: center; justify-content: center;
    font-size: 14px; color: #94a3b8;
}
.miner-modal__cell--mine { background: rgba(239,68,68,0.3); color: #ef4444; }
.miner-modal__cell--diamond { background: rgba(34,197,94,0.2); color: #22c55e; }
.miner-modal__cell--clicked { background: rgba(249,115,22,0.3); color: #f97316; }
.miner-modal__hint { color: #64748b; font-size: 12px; margin-top: 12px; }
</style>
