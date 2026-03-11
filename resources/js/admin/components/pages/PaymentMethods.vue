<template>
    <div>
        <div class="kt-subheader kt-grid__item" id="kt_subheader">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">База методов</h3>
            </div>
        </div>

        <div
            class="kt-content kt-grid__item kt-grid__item--fluid"
            id="kt_content"
        >
            <div class="kt-portlet kt-portlet--mobile">
                <div class="kt-portlet__head kt-portlet__head--lg">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">Список методов</h3>
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
                                <th>Код метода</th>
                                <th>Изображение</th>
                                <th>Апи</th>
                                <th>Мин. деп.</th>
                                <th>Статус</th>
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
                                <label>Код метода:</label>
                                <input
                                    type="text"
                                    v-model="editItem.name"
                                    class="form-control"
                                    name="name"
                                />
                            </div>
                            <div class="form-group">
                                <label>Изображение:</label>
                                <input
                                    type="text"
                                    v-model="editItem.icon"
                                    class="form-control"
                                    name="icon"
                                />
                            </div>
                            <div class="form-group">
                                <label>Апи:</label>
                                <input
                                    type="text"
                                    v-model="editItem.apiUrl"
                                    class="form-control"
                                    name="apiUrl"
                                />
                            </div>
                            <div class="form-group">
                                <label>Мин. деп:</label>
                                <input
                                    type="text"
                                    v-model="editItem.min_dep"
                                    class="form-control"
                                    name="minDep"
                                />
                            </div>

                            <div class="form-group">
                                <label>Статус:</label>
                                <select
                                    class="form-control"
                                    v-model="editItem.status"
                                >
                                    <option
                                        :selected="editItem.status"
                                        value="1"
                                    >
                                        Включить
                                    </option>
                                    <option
                                        :selected="editItem.status"
                                        value="0"
                                    >
                                        Отключить
                                    </option>
                                </select>
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
    </div>
</template>

<script>
import axios from "axios";

export default {
    data() {
        return {
            colors: [],
            editItem: {
                id: null,
                name: null,
                icon: null,
                apiUrl: null,
                min_dep: null,
                type: null,
                status: null,
            },
            createItem: {
                id: null,
                name: null,
                icon: null,
                apiUrl: null,
                min_dep: null,
                type: null,
                status: null,
            },
        };
    },
    methods: {
        async load() {
            const app = this;
            const table = $("#items");

            table.dataTable().fnDestroy();

            table.DataTable({
                responsive: true,
                searchDelay: 500,
                processing: true,
                serverSide: true,
                ajax: {
                    url: "/api/admin/payment/load",
                    type: "POST",
                },
                columns: [
                    { data: "id", searchable: true },
                    { data: "name", searchable: true },
                    {
                        data: "icon",
                        searchable: false,
                        render: function (data, type, row) {
                            return (
                                '<img width="60px" height="60px" src="' +
                                row.icon +
                                '">'
                            );
                        },
                    },
                    {
                        data: "apiUrl",
                        searchable: true,
                        render: function (data, type, row) {
                            return row.apiUrl;
                        },
                    },
                    {
                        data: "min_dep",
                        searchable: true,
                        render: function (data, type, row) {
                            return row.min_dep;
                        },
                    },

                    {
                        data: "status",
                        searchable: false,
                        render: function (data, type, row) {
                            return data === 1 ? "Включен" : "Отключен";
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
        async edit(id) {
            const request = await axios.post("/payment/get", { id: id });
            const data = request.data;

            if (data.success) {
                this.editItem = request.data.item;
                $("#edit").modal("show");
            } else {
                this.$toast.error(data.message);
            }
        },
        async editSave() {
            const request = await axios.post("/payment/edit", {
                item: this.editItem,
            });
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
