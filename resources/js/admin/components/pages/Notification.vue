<template>
    <div>
        <div class="kt-subheader kt-grid__item" id="kt_subheader">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">Уведомления</h3>
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
                            Список уведомлений
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
                        id="notification"
                    >
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Создан</th>
                                <th>Заголовок</th>
                                <th>Контент</th>
                                <th>Ссылка</th>
                                <th>Действия</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="notification in notification">
                                <td>{{ notification.id }}</td>
                                <td>
                                    {{ formatDate(notification.created_at) }}
                                </td>

                                <td>{{ notification.title }}</td>
                                <td>{{ notification.content }}</td>
                                <td>{{ notification.link }}</td>

                                <td>
                                    <a
                                        class="btn btn-sm btn-clean btn-icon btn-icon-md"
                                        v-on:click="edit(notification.id)"
                                        title="Редактировать"
                                    >
                                        <i class="la la-edit"></i>
                                    </a>
                                    <a
                                        class="btn btn-sm btn-clean btn-icon btn-icon-md"
                                        v-on:click="del(notification.id)"
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
                            Создать уведомление
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
                                <label>Заголовок:</label>
                                <input
                                    type="text"
                                    v-model="newNotification.title"
                                    class="form-control"
                                />
                            </div>

                            <div class="form-group">
                                <label>Контент:</label>
                                <input
                                    type="text"
                                    v-model="newNotification.content"
                                    class="form-control"
                                />
                            </div>
                            <div class="form-group">
                                <label>Ссылка:</label>
                                <input
                                    type="text"
                                    v-model="newNotification.link"
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
                            Изменить уведомление
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
                                    v-model="editNotification.title"
                                    class="form-control"
                                />
                            </div>
                            <div class="form-group">
                                <label>Контент:</label>
                                <input
                                    type="text"
                                    v-model="editNotification.content"
                                    class="form-control"
                                />
                            </div>
                            <div class="form-group">
                                <label>Ссылка:</label>
                                <input
                                    type="text"
                                    v-model="editNotification.link"
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
            notification: [],
            newNotification: {
                title: null,
                content: null,
                link: null,
            },
            editNotification: {
                title: null,
                content: null,
                link: null,
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
            const request = await axios.post("/notification/load");

            this.notification = request.data;

            const table = $("#notification");

            table.DataTable().destroy();
            this.$nextTick(function () {
                table.DataTable();
            });
        },
        async create() {
            try {
                // Отправка POST-запроса
                const response = await axios.post("/notification/create", {
                    notification: this.newNotification,
                });

                // Извлечение данных из ответа
                const result = response.data;

                // Показ сообщения об успешном создании
                this.$toast.success(result.message);

                // Закрытие модального окна
                $("#new").modal("hide");

                // Сброс формы
                this.newNotification = {
                    title: null,
                    content: null,
                    link: null,
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
            const request = await axios.post("/notification/get", { id: id });
            const data = request.data;

            if (data.success) {
                this.editNotification = request.data.notification;
                $("#edit").modal("show");
            } else {
                this.$toast.success(data.message);
            }
        },
        async saveEdit() {
            const request = await axios.post("/notification/edit", {
                notification: this.editNotification,
            });
            const data = request.data;

            this.load();

            this.$toast.success(data.message);
        },
        async del(id) {
            const request = await axios.post("/notification/del", { id: id });
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
