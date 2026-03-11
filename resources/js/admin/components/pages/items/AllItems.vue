<template>
    <div>
        <div class="kt-subheader kt-grid__item" id="kt_subheader">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">База предметов</h3>
            </div>
        </div>

        <div
            class="kt-content kt-grid__item kt-grid__item--fluid"
            id="kt_content"
        >
            <div class="kt-portlet kt-portlet--mobile">
                <div class="kt-portlet__head kt-portlet__head--lg">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">Список предметов</h3>
                    </div>
                    <div class="kt-portlet__head-toolbar">
                        <div class="kt-portlet__head-wrapper">
                            <div class="kt-portlet__head-actions">
                                <button
                                    v-on:click="updateList()"
                                    style="color: #fff; cursor: pointer"
                                    class="btn btn-success btn-elevate btn-icon-sm"
                                >
                                    Обновить лист предметов
                                </button>
                                <button
                                    v-on:click="updateMarket()"
                                    style="color: #fff; cursor: pointer"
                                    class="btn btn-success btn-elevate btn-icon-sm"
                                >
                                    Обновить цены по маркету
                                </button>

                                <a
                                    data-toggle="modal"
                                    href="#create"
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
                        id="items"
                    >
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>ClassID</th>
                                <th>Название</th>
                                <th>Изображение</th>
                                <th>Цена</th>
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
            id="edit"
            tabindex="-1"
            role="dialog"
            aria-labelledby="newLabel"
            aria-hidden="true"
        >
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">
                            Редактировать предмет
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
                                    v-model="editItem.market_hash_name"
                                    class="form-control"
                                    name="market_hash_name"
                                />
                            </div>
                            <div class="form-group">
                                <label>Изображение:</label>
                                <input
                                    type="text"
                                    v-model="editItem.icon_url"
                                    class="form-control"
                                    name="icon_url"
                                />
                            </div>
                            <div class="form-group">
                                <label>Цена:</label>
                                <input
                                    type="text"
                                    v-model="editItem.price"
                                    class="form-control"
                                    name="price"
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
                                v-on:click="editSave"
                            >
                                Сохранить
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div
            class="modal fade"
            id="create"
            tabindex="-1"
            role="dialog"
            aria-labelledby="newLabel"
            aria-hidden="true"
        >
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createModalLongTitle">
                            Создать предмет
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
                                <label>ClassID предмета:</label>
                                <input
                                    type="text"
                                    v-model="createItem.classid"
                                    class="form-control"
                                    name="classid"
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
    </div>
</template>

<script>
export default {
    data() {
        return {
            editItem: {
                id: null,
                market_hash_name: null,
                icon_url: null,
                price: null,
            },
            createItem: {
                classid: null,
            },
        };
    },
    methods: {
        load() {
            const app = this;
            const table = $("#items");

            table.dataTable().fnDestroy();

            table.DataTable({
                responsive: true,
                searchDelay: 500,
                processing: true,
                serverSide: true,
                ajax: {
                    url: "/api/admin/items/load",
                    type: "GET",
                },
                columns: [
                    { data: "id", searchable: true },
                    { data: "classid", searchable: true },
                    { data: "market_hash_name", searchable: true },
                    {
                        data: "icon_url",
                        searchable: false,
                        render: function (data, type, row) {
                            return (
                                '<img width="60px" height="60px" src="https://steamcommunity-a.akamaihd.net/economy/image/' +
                                row.icon_url +
                                '/360fx360f/image.png">'
                            );
                        },
                    },
                    {
                        data: "price",
                        searchable: true,
                        render: function (data, type, row) {
                            return (
                                new Intl.NumberFormat("ru").format(row.price) +
                                '<i class="la la-rub"></i>'
                            );
                        },
                    },
                    {
                        data: null,
                        searchable: false,
                        orderable: false,
                        render: function (data, type, row) {
                            return (
                                '                                <a class="btn btn-sm btn-clean btn-icon btn-icon-md editItem" data-id="' +
                                row.id +
                                '" title="Редактировать">\n' +
                                '                                    <i class="la la-edit"></i>\n' +
                                "                                </a>\n" +
                                '                                <a class="btn btn-sm btn-clean btn-icon btn-icon-md delItem" data-id="' +
                                row.id +
                                '" title="Удалить">\n' +
                                '                                    <i class="la la-trash"></i>\n' +
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

            $(document).on("click", ".editItem", function () {
                app.edit($(this).attr("data-id"));
            });

            $(document).on("click", ".delItem", function () {
                app.del($(this).attr("data-id"));
            });
        },
        edit(id) {
            this.axios.post("/items/get", { id: id }).then((res) => {
                let result = res.data;

                if (result.success) {
                    this.editItem = result.item;
                    $("#edit").modal("show");
                }

                if (!result.success) {
                    this.$toast.error(result.message);
                }
            });
        },
        editSave() {
            this.axios
                .post("/items/edit", { item: this.editItem })
                .then((res) => {
                    let result = res.data;

                    if (result.success) {
                        $("#edit").modal("hide");
                        this.$toast.success(result.message);
                        this.load();
                    }

                    if (!result.success) {
                        this.$toast.error(result.message);
                    }
                });
        },
        del(id) {
            this.axios.post("/items/delete", { id: id }).then((res) => {
                let result = res.data;

                if (result.success) {
                    this.load();
                    this.$toast.success(result.message);
                }

                if (!result.success) {
                    this.$toast.error(result.message);
                }
            });
        },
        create() {
            this.axios
                .post("/items/create", { classid: this.createItem.classid })
                .then((res) => {
                    let result = res.data;

                    if (result.success) {
                        this.$toast.success(result.message);

                        this.load();
                        $("#create").modal("hide");

                        this.createItem = {
                            classid: null,
                        };
                    }

                    if (!result.success) {
                        this.$toast.error(result.message);
                    }
                });
        },
        update() {
            this.$toast.info("Началось обновление цен...");

            this.axios.post("/items/steamp").then((res) => {
                let result = res.data;

                if (result.success) {
                    this.$toast.success(result.message);
                }

                if (!result.success) {
                    this.$toast.error(result.message);
                }
            });
        },
        updateList() {
            this.$toast.info("Добавляем предметы...");

            this.axios.post("/items/list").then((res) => {
                let result = res.data;

                if (result.success) {
                    this.$toast.success(result.message);
                }

                if (!result.success) {
                    this.$toast.error(result.message);
                }
            });
        },
        updateMarket() {
            this.$toast.info("Началось обновление цен...");

            this.axios.post("/items/market").then((res) => {
                let result = res.data;

                if (result.success) {
                    this.$toast.success(result.message);
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
