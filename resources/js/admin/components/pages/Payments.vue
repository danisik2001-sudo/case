<template>
    <div>
        <div class="kt-subheader kt-grid__item" id="kt_subheader">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">Пополнения</h3>
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
                            Список пополнений
                        </h3>
                    </div>
                    <div class="kt-portlet__head-toolbar">
                        <div class="kt-portlet__head-wrapper">
                            <div class="kt-portlet__head-actions">
                                <a
                                    data-toggle="modal"
                                    href="#fakepayment"
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
                        id="payments"
                    >
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Создан</th>
                                <th>Пользователь</th>
                                <th>Метод</th>
                                <th>№ Заказа</th>
                                <th>Промокод</th>
                                <th>Сумма</th>
                                <th>Статус</th>
                                <th>Комментарий</th>
                                <th>Действие</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="payment in payments">
                                <td>{{ payment.id }}</td>
                                <td>{{ formatDate(payment.created_at) }}</td>
                                <td>
                                    <router-link
                                        target="_blank"
                                        :to="{
                                            name: 'user',
                                            params: { id: payment.user.id },
                                        }"
                                        >{{
                                            payment.user.username
                                        }}</router-link
                                    >
                                </td>
                                <td>
                                    {{
                                        payment.type !== null &&
                                        payment.type !== ""
                                            ? payment.type
                                            : "Не использовался"
                                    }}
                                </td>
                                <td>
                                    {{
                                        payment.promocode !== null &&
                                        payment.promocode !== ""
                                            ? payment.promocode
                                            : "Не использовался"
                                    }}
                                </td>
                                <td>
                                    {{
                                        payment.invoice !== null &&
                                        payment.invoice !== ""
                                            ? payment.invoice
                                            : "Не использовался"
                                    }}
                                </td>
                                <td>
                                    {{
                                        new Intl.NumberFormat("ru").format(
                                            payment.sum
                                        )
                                    }}
                                    <i class="la la-rub"></i>
                                </td>

                                <td>
                                    <div
                                        class="badge badge-success"
                                        v-if="payment.status"
                                    >
                                        Оплачен
                                    </div>
                                    <div
                                        class="badge badge-warning text-white"
                                        v-if="!payment.status"
                                    >
                                        Ожидает оплаты
                                    </div>
                                </td>
                                <td>
                                    {{
                                        payment.description !== null &&
                                        payment.description !== ""
                                            ? payment.description
                                            : ""
                                    }}
                                </td>
                                <td>
                                    <a
                                        class="btn btn-sm btn-clean btn-icon btn-icon-md"
                                        @click="del(payment.id)"
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
            id="fakepayment"
            tabindex="-1"
            role="dialog"
            aria-labelledby="newLabel"
            aria-hidden="true"
        >
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">
                            Создать депозит
                        </h5>
                        <button
                            type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close"
                        ></button>
                    </div>
                    <form
                        class="kt-form-new"
                        onclick="return false;"
                        enctype="multipart/form-data"
                    >
                        <div class="modal-body">
                            <div class="row">
                                <div class="form-group col-lg-6">
                                    <label>Айди пользователя:</label>
                                    <input
                                        type="text"
                                        v-model="newPayment.user_id"
                                        placeholder="123456"
                                        class="form-control"
                                    />
                                </div>
                                <div class="form-group col-lg-6">
                                    <label>Сумма:</label>
                                    <input
                                        type="text"
                                        v-model="newPayment.sum"
                                        placeholder="1000"
                                        class="form-control"
                                    />
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-lg-12">
                                    <label>Тип:</label>
                                    <input
                                        type="text"
                                        v-model="newPayment.type"
                                        placeholder="Fake"
                                        class="form-control"
                                    />
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Комментарий:</label>
                                <input
                                    type="text"
                                    v-model="newPayment.description"
                                    placeholder="На ролик"
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
                                @click="create"
                            >
                                Создать
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            payments: [],
            newPayment: {
                user_id: "",
                sum: "",
                type: "",
                status: 1,
                description: "",
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
        load() {
            this.axios.post("/payments/load").then((res) => {
                let result = res.data;

                this.payments = result;

                const table = $("#payments");

                table.DataTable().destroy();
                this.$nextTick(function () {
                    table.DataTable();
                });
            });
        },
        del(id) {
            this.axios.post("/payments/delete", { id: id }).then((res) => {
                let result = res.data;

                if (result.success) {
                    this.$toast.success(result.message);
                    this.load();
                }

                if (!result.success) {
                    this.$toast.error(result.message);
                }
            });
        },
        create() {
            let data = new FormData();
            for (let key in this.newPayment) {
                data.append(key, this.newPayment[key]);
            }
            const config = {
                headers: {
                    "content-type": "multipart/form-data",
                },
            };

            this.axios.post("/payments/create", data, config).then((res) => {
                let result = res.data;

                if (result.success) {
                    this.$toast.success(result.message);

                    $("#fakepayment").modal("hide");

                    this.newPayment = {
                        user_id: "",
                        sum: "",
                        type: "",
                        status: 1,
                        description: "",
                    };

                    this.load();
                }

                if (!result.success) {
                    this.$toast.error(result.message);
                }
            });
        },
    },
    mounted() {
        this.load();
    },
};
</script>
