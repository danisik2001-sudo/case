<template>
    <div>
        <div class="kt-subheader kt-grid__item" id="kt_subheader">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">Пользователи</h3>
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
                            Список пользователей
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
                                    Добавить бота
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <table
                        class="table table-striped- table-bordered table-hover table-checkable"
                        id="users"
                    >
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Имя</th>
                                <th>Аватар</th>
                                <th>Профиль на сайте</th>
                                <th>Баланс</th>
                                <th>Действия</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
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
                            Создать пользователя
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
                                <label>SteamID64:</label>
                                <input
                                    type="text"
                                    v-model="steamid"
                                    class="form-control"
                                />
                            </div>
                            <div class="form-group">
                                <label for="name">Тип</label>
                                <select class="form-control" v-model="type">
                                    <option selected value="fake">Бот</option>
                                    <option value="default">
                                        Пользователь
                                    </option>
                                </select>
                            </div>
                            <div
                                class="row"
                                id="prof"
                                v-if="Object.keys(user).length > 0"
                            >
                                <div class="col-xl-12">
                                    <div class="kt-section__body">
                                        <div class="form-group row">
                                            <label
                                                class="col-xl-3 col-lg-3 col-form-label"
                                                >Аватар</label
                                            >
                                            <div class="col-lg-9 col-xl-6">
                                                <div
                                                    class="kt-avatar kt-avatar&#45;&#45;outline kt-avatar&#45;&#45;circle"
                                                    id="kt_apps_user_add_avatar"
                                                >
                                                    <img
                                                        class="kt-avatar__holder"
                                                        id="ava"
                                                        :src="user.avatarfull"
                                                    />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label
                                                class="col-xl-3 col-lg-3 col-form-label"
                                                >Никнейм</label
                                            >
                                            <div class="col-lg-9 col-xl-9">
                                                <input
                                                    class="form-control"
                                                    type="text"
                                                    v-model="user.personaname"
                                                    name="name"
                                                    id="name"
                                                    disabled
                                                />
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
                                Добавить
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
            user: {},
        };
    },
    methods: {
        load() {
            const app = this;
            const table = $("#users");

            table.dataTable().fnDestroy();

            table.DataTable({
                responsive: true,
                searchDelay: 500,
                processing: true,
                serverSide: true,
                ajax: {
                    url: "/api/admin/users/load",
                    type: "GET",
                },
                columns: [
                    { data: "id", searchable: true },
                    { data: "username", searchable: true },
                    {
                        data: "avatar",
                        searchable: false,
                        render: function (data, type, row) {
                            return data
                                ? `<img src="${data}" alt="Avatar" class="kt-avatar__holder" style="width: 40px; height: 40px; border-radius: 8px;">`
                                : "Нет аватара";
                        },
                    },
                    {
                        data: null,
                        searchable: false,
                        render: function (data, type, row) {
                            return (
                                '<a target="_blank" href="/user/' +
                                row.id +
                                '">Профиль</a>'
                            );
                        },
                    },
                    {
                        data: "balance",
                        searchable: true,
                        render(data, type, row) {
                            return (
                                new Intl.NumberFormat("ru").format(
                                    row.balance
                                ) + '<i class="la la-rub"></i>'
                            );
                        },
                    },
                    {
                        data: null,
                        searchable: false,
                        render: function (data, type, row) {
                            return (
                                '                                <a class="btn btn-sm btn-clean btn-icon btn-icon-md editUser" data-id="' +
                                row.id +
                                '" title="Редактировать">\n' +
                                '                                    <i class="la la-edit"></i>\n' +
                                "                                </a>"
                            );
                        },
                    },
                ],

                language: {
                    processing: "Подождите...",
                    search: "Поиск:",
                    lengthMenu: "Показать _MENU_ записей",
                    info: "Записи с _START_ по _END_ из _TOTAL_ записей",
                    infoEmpty: "Записи с 0 до 0 из 0 записей",
                    infoFiltered: "(отфильтровано из _MAX_ записей)",
                    infoPostFix: "",
                    loadingRecords: "Загрузка записей...",
                    zeroRecords: "Записи отсутствуют.",
                    emptyTable: "В таблице отсутствуют данные",
                    paginate: {
                        first: "Первая",
                        previous: "Предыдущая",
                        next: "Следующая",
                        last: "Последняя",
                    },
                    aria: {
                        sortAscending:
                            ": активировать для сортировки столбца по возрастанию",
                        sortDescending:
                            ": активировать для сортировки столбца по убыванию",
                    },
                },
            });

            $(document).on("click", ".editUser", function () {
                app.edit($(this).attr("data-id"));
            });
        },
        edit(id) {
            this.$router.replace({
                name: "user",
                params: {
                    id: id,
                },
            });
        },
        async create() {
            const request = await axios.post("/users/create", {
                user: this.steamid,
                type: this.type,
            });
            const data = request.data;

            if (data.success) {
                $("#new").modal("hide");
                this.steamid = "";
                this.user = {};
                this.load();
                this.$toast.success(data.message);
            }
            if (!data.success) {
                this.$toast.error(data.message);
            }
        },
    },
    mounted() {
        this.load();
    },
};
</script>
