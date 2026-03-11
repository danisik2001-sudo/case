<template>
    <div>
        <div class="kt-subheader kt-grid__item" id="kt_subheader">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">Список выводов</h3>
            </div>
        </div>

        <div
            class="kt-content kt-grid__item kt-grid__item--fluid"
            id="kt_content"
        >
            <div class="kt-portlet kt-portlet--mobile">
                <div class="kt-portlet__head kt-portlet__head--lg">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">Список выводов</h3>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <table
                        class="table table-striped- table-bordered table-hover table-checkable"
                        id="withdraws"
                    >
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Пользователь</th>
                                <th>Предмет</th>
                                <th>Стоимость вывода</th>
                                <th>Статус</th>
                                <th>Дата</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import moment from "moment";

export default {
    data() {
        return {
            withdraws: [],
        };
    },
    mounted() {
        this.load();
    },
    methods: {
        load() {
            const app = this;
            const table = $("#withdraws");

            table.dataTable().fnDestroy();

            table.DataTable({
                responsive: true,
                searchDelay: 500,
                processing: true,
                serverSide: true,
                ajax: {
                    url: "/api/admin/withdraws/load",
                    type: "GET",
                },
                columns: [
                    { data: "id", searchable: true },
                    {
                        data: null,
                        searchable: true,
                        render: function (data, type, row) {
                            return (
                                '<a href="/admin/user/' +
                                row.user_id +
                                '" >' +
                                row.user.username +
                                "</a>"
                            );
                        },
                    },
                    {
                        data: null,
                        searchable: true,
                        render: function (data, type, row) {
                            return row.item.market_hash_name;
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
                        data: "status",
                        searchable: false,
                        orderable: false,
                        render: function (data, type, row) {
                            if (
                                row.status === 2 ||
                                row.status === 3 ||
                                row.status === 4 ||
                                row.status === 5
                            ) {
                                return '<div class="badge badge-warning text-white">Ожидает вывода / получения</div>';
                            }
                            if (row.status === 6) {
                                return '<div class="badge badge-success">Предмет отправлен</div';
                            }
                        },
                    },
                    {
                        data: "created_at",
                        searchable: true,
                        render: function (data, type, row) {
                            return moment(row.updated_at).format(
                                "DD/MM/YYYY, h:mm"
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

            // $(document).on('click', '.editItem', function() {
            //     app.edit($(this).attr('data-id'));
            // });
            //
            // $(document).on('click', '.delItem', function() {
            //     app.del($(this).attr('data-id'));
            // });
        },
    },
};
</script>
