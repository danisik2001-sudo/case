<template>
    <div>
        <div class="kt-subheader kt-grid__item" id="kt_subheader">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">Промокоды</h3>
            </div>
        </div>

        <div
            class="kt-content kt-grid__item kt-grid__item--fluid"
            id="kt_content"
        >
            <div class="kt-portlet kt-portlet--mobile">
                <div class="kt-portlet__head kt-portlet__head--lg">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            Список промокодов
                        </h3>
                    </div>
                    <div class="kt-portlet__head-toolbar">
                        <div class="kt-portlet__head-wrapper">
                            <div class="kt-portlet__head-actions">
                                <a
                                    data-toggle="modal"
                                    href="#new"
                                    class="btn btn-success btn-elevate btn-icon-sm"
                                >
                                    <i class="la la-plus"></i>
                                    Добавить
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <table
                        class="table table-striped- table-bordered table-hover table-checkable"
                        id="promocodes"
                    >
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Создан</th>
                                <th>Создал</th>
                                <th>Имя промокода</th>
                                <th>Тип промокода</th>
                                <th>Значение</th>
                                <th>Кол-во</th>
                                <th>Общее пополнение</th>
                                <th>Действие</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="promocode in promocodes">
                                <td>{{ promocode.id }}</td>
                                <td>{{ formatDate(promocode.created_at) }}</td>
                                <td>
                                    <a
                                        target="_blank"
                                        :href="'/admin/user/' + promocode.owner"
                                        >Профиль</a
                                    >
                                </td>
                                <td>{{ promocode.name }}</td>
                                <td>{{ promocode.type }}</td>
                                <td>{{ promocode.percent }}</td>
                                <td>{{ promocode.activates }}</td>
                                <td>{{ promocode.total_deposit }}</td>
                                <td>
                                    <a
                                        class="btn btn-sm btn-clean btn-icon btn-icon-md"
                                        v-on:click="edit(promocode.id)"
                                        title="Редактировать"
                                    >
                                        <i class="la la-edit"></i>
                                    </a>
                                    <a
                                        class="btn btn-sm btn-clean btn-icon btn-icon-md"
                                        v-on:click="del(promocode.id)"
                                        title="Удалить"
                                    >
                                        <i class="la la-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div
            class="modal fade"
            id="new"
            tabindex="-1"
            role="dialog"
            aria-labelledby="newLabel"
            aria-hidden="true"
        >
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">
                            Создать промокод
                        </h5>
                        <button
                            type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close"
                        ></button>
                    </div>
                    <form class="kt-form-new" onclick="return false;">
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Имя промокода:</label>
                                <input
                                    type="text"
                                    v-model="newPromocode.name"
                                    class="form-control"
                                />
                            </div>
                            <div class="form-group">
                                <label>Тип промокода:</label>
                                <select
                                    class="form-control"
                                    v-model="newPromocode.type"
                                >
                                    <option
                                        :selected="newPromocode.type"
                                        value="percent"
                                    >
                                        Процент к депозиту
                                    </option>
                                    <option
                                        :selected="newPromocode.type"
                                        value="cases"
                                    >
                                        Бесплатное открытие кейса
                                    </option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Значение:</label>
                                <input
                                    type="text"
                                    v-model="newPromocode.percent"
                                    class="form-control"
                                />
                            </div>
                            <div class="form-group">
                                <label>Макс. кол-во использований:</label>
                                <input
                                    type="text"
                                    v-model="newPromocode.activates"
                                    class="form-control"
                                />
                            </div>
                            <div class="form-group">
                                <label>Общее пополнение:</label>
                                <input
                                    type="text"
                                    v-model="newPromocode.total_deposit"
                                    disabled
                                    class="form-control"
                                />
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button
                                type="button"
                                class="btn btn-secondary"
                                data-dismiss="modal"
                            >
                                Закрыть
                            </button>
                            <button
                                type="submit"
                                class="btn btn-primary"
                                v-on:click="create"
                            >
                                Создать
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div
            class="modal fade"
            id="edit"
            tabindex="-1"
            role="dialog"
            aria-labelledby="newLabel"
            aria-hidden="true"
        >
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLongTitle">
                            Изменить промокод
                        </h5>
                        <button
                            type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close"
                        ></button>
                    </div>
                    <form class="kt-form-new" onclick="return false;">
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Название:</label>
                                <input
                                    type="text"
                                    v-model="editPromocode.name"
                                    class="form-control"
                                />
                            </div>
                            <div class="form-group">
                                <label>Процент:</label>
                                <input
                                    type="text"
                                    v-model="editPromocode.percent"
                                    class="form-control"
                                />
                            </div>
                            <div class="form-group">
                                <label>Макс. кол-во использований:</label>
                                <input
                                    type="text"
                                    v-model="editPromocode.activates"
                                    class="form-control"
                                />
                            </div>
                            <div class="form-group">
                                <label>Сумма депозитов:</label>
                                <input
                                    type="text"
                                    v-model="editPromocode.total_deposit"
                                    disabled
                                    class="form-control"
                                />
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button
                                type="button"
                                class="btn btn-secondary"
                                data-dismiss="modal"
                            >
                                Закрыть
                            </button>
                            <button
                                type="submit"
                                class="btn btn-primary"
                                v-on:click="saveEdit"
                            >
                                Сохранить
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
    data() {
        return {
            promocodes: [],
            newPromocode: {
                name: null,
                percent: null,
                activates: null,
                created_at: null,
                type: null,
                total_deposit: 0,
                owner: null,
            },
            editPromocode: {
                name: null,
                percent: null,
                activates: null,
                created_at: null,
                type: null,
                total_deposit: 0,
                owner: null,
            },
        };
    },
    methods: {
        formatDate(dateString) {
            const date = new Date(dateString);
            const day = String(date.getDate()).padStart(2, "0");
            const month = String(date.getMonth() + 1).padStart(2, "0");
            const year = date.getFullYear(); // Год
            const hours = String(date.getHours()).padStart(2, "0");
            const minutes = String(date.getMinutes()).padStart(2, "0");

            return `${day}.${month}.${year} ${hours}:${minutes}`;
        },
        async load() {
            const request = await axios.post("/promocodes/load");

            this.promocodes = request.data;

            const table = $("#promocodes");

            table.DataTable().destroy();
            this.$nextTick(function () {
                table.DataTable();
            });
        },
        async create() {
            try {
                // Отправка POST-запроса
                const response = await axios.post("/promocodes/create", {
                    promocode: this.newPromocode,
                });

                // Извлечение данных из ответа
                const result = response.data;

                // Показ сообщения об успешном создании
                this.$toast.success(result.message);

                // Закрытие модального окна
                $("#new").modal("hide");

                // Сброс формы
                this.newPromocode = {
                    name: null,
                    percent: null,
                    activates: null,
                    created_at: null,
                    type: null,
                    total_deposit: 0,
                    owner: null,
                };

                // Перезагрузка данных
                this.load();
            } catch (error) {
                // Обработка ошибок
                console.error(error);
                this.$toast.error(
                    "Ошибка при создании промокода: " + error.message
                );
            }
        },
        async edit(id) {
            const request = await axios.post("/promocodes/get", { id: id });
            const data = request.data;

            if (data.success) {
                this.editPromocode = request.data.promocode;
                $("#edit").modal("show");
            } else {
                this.$toast.success(data.message);
            }
        },
        async saveEdit() {
            const request = await axios.post("/promocodes/edit", {
                promocode: this.editPromocode,
            });
            const data = request.data;

            this.load();

            this.$toast.success(data.message);
        },
        async del(id) {
            const request = await axios.post("/promocodes/del", { id: id });
            const data = request.data;

            this.load();

            this.$toast.success(data.message);
        },
    },
    mounted() {
        this.load();
    },
};
</script>
