<template>
    <div>
        <div class="kt-subheader kt-grid__item" id="kt_subheader">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">
                    Предметы в кейсе "{{ box.name }}"
                </h3>
            </div>
        </div>

        <div
            class="kt-content kt-grid__item kt-grid__item--fluid"
            id="kt_content"
        >
            <div class="kt-portlet kt-portlet--mobile">
                <div class="kt-portlet__head kt-portlet__head--lg">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">Предметы</h3>
                    </div>
                    <div class="kt-portlet__head-toolbar">
                        <div class="kt-portlet__head-wrapper">
                            <div class="kt-portlet__head-actions">
                                <button
                                    @click="generateItems"
                                    class="btn btn-success btn-elevate btn-icon-sm"
                                >
                                    Сгенерировать кейс
                                </button>
                                <button
                                    @click="calculateChance"
                                    class="btn btn-success btn-elevate btn-icon-sm"
                                >
                                    Рассчитать шансы
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
                                <th>Название</th>
                                <th>Картинка</th>
                                <th>Цена (₽)</th>
                                <th>Шансы</th>
                                <th>Действия</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="item in items">
                                <td>{{ item.item.market_hash_name }}</td>
                                <td>
                                    <img
                                        :src="
                                            'https://steamcommunity-a.akamaihd.net/economy/image/' +
                                            item.item.icon_url
                                        "
                                        width="64"
                                        height="64"
                                    />
                                </td>
                                <td>{{ item.item.price }}</td>
                                <td>{{ item.chance }}</td>
                                <td>
                                    <a
                                        class="btn btn-sm btn-clean btn-icon btn-icon-md"
                                        @click="edit(item.id)"
                                        title="Редактировать"
                                    >
                                        <i class="la la-edit"></i>
                                    </a>
                                    <a
                                        class="btn btn-sm btn-clean btn-icon btn-icon-md"
                                        @click="del(item.id)"
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
                            Добавить предмет
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
                                <label>Предмет:</label>
                                <select id="selectItem"></select>
                                <small>Поиск по названию и цене</small>
                            </div>
                            <div class="form-group">
                                <label>Шанс:</label>
                                <input
                                    type="text"
                                    v-model="createItem.chance"
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
                                Добавить
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
                            Изменить предмет
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
                                <label>Предмет:</label>
                                <select id="editItem"></select>
                                <small>Поиск по названию и цене</small>
                            </div>
                            <div class="form-group">
                                <label>Шанс:</label>
                                <input
                                    type="text"
                                    v-model="editItem.chance"
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
                                @click="saveEdit"
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
            box: {},
            items: [],
            createItem: {
                chance: 100,
            },
            editItem: {
                id: null,
                chance: 100,
            },
        };
    },
    methods: {
        get() {
            this.axios
                .post("/cases/items/load", { id: this.$route.params.id })
                .then((res) => {
                    let result = res.data;

                    if (result.success) {
                        this.box = result.box;
                        this.items = result.items;

                        const table = $("#items");

                        table.DataTable().destroy();
                        this.$nextTick(function () {
                            table.DataTable();
                        });
                    }

                    if (!result.success) {
                        this.$router.go(-1);
                    }
                });
        },
        create() {
            this.$toast.info("Предмет добавляется...");

            this.axios
                .post("/cases/items/create", {
                    case_id: this.box.id,
                    item_id: $("#selectItem option").last().val(),
                    chance: this.createItem.chance,
                })
                .then((res) => {
                    let result = res.data;

                    if (result.success) {
                        this.get();

                        $("#selectItem").html("");
                        this.createItem = {
                            chance: null,
                        };
                        $("#create").modal("hide");

                        this.$toast.success(result.message);
                    }

                    if (!result.success) {
                        this.$toast.error(result.message);
                    }
                });
        },
        edit(id) {
            this.axios.post("/cases/items/get", { id: id }).then((res) => {
                let result = res.data;

                if (result.success) {
                    this.editItem = result.cases;

                    const item = {
                        id: result.item.id,
                        text: result.item.text,
                    };

                    const newOption = new Option(
                        item.text,
                        item.id,
                        true,
                        true
                    );
                    $("#editItem").prepend(newOption).trigger("change");

                    $("#edit").modal("show");
                }

                if (!result.success) {
                    this.$toast.error(result.message);
                }
            });
        },
        saveEdit() {
            this.axios
                .post("/cases/items/edit", {
                    id: this.editItem.id,
                    chance: this.editItem.chance,
                })
                .then((res) => {
                    let result = res.data;

                    if (result.success) {
                        this.get();
                        $("#edit").modal("hide");
                        this.$toast.success(result.message);
                    }

                    if (!result.message) {
                        this.$toast.error(result.message);
                    }
                });
        },
        del(id) {
            this.axios.post("/cases/items/delete", { id: id }).then((res) => {
                let result = res.data;

                if (result.success) {
                    this.get();
                    this.$toast.success(result.message);
                }

                if (!result.success) {
                    this.$toast.error(result.message);
                }
            });
        },
        calculateChance() {
            axios
                .post("/cases/items/calc", { id: this.box.id })
                .then((res) => {
                    let result = res.data;

                    if (result.success) {
                        this.items = result.chances;
                        this.$toast.success("Шансы успешно расчитаны!");
                        this.get();
                    } else {
                        this.$toast.error(result.message);
                    }
                })
                .catch((error) => {
                    this.$toast.error("Ошибка ");
                });
        },
        generateItems() {
            axios
                .post("/cases/items/generate", { id: this.box.id })
                .then((res) => {
                    let result = res.data;

                    if (result.success) {
                        this.$toast.success("Предметы успешно подобраны!");
                        this.get();
                    } else {
                        this.$toast.error(result.message);
                    }
                })
                .catch((error) => {
                    this.$toast.error("Ошибка ");
                });
        },
    },
    mounted() {
        this.get();

        $("#selectItem").select2({
            theme: "bootstrap4",
            dropdownParent: $("#create"),
            ajax: {
                delay: 250,
                url: "/api/admin/cases/items/all",
                type: "GET",
                data: function (params) {
                    const query = {
                        search: params.term,
                        page: params.page || 1,
                    };

                    return query;
                },
                processResults: function (data, params) {
                    return {
                        results: data.results,
                        pagination: {
                            more: data.more,
                        },
                    };
                },
            },
        });
        $("#editItem").select2({
            theme: "bootstrap4",
            dropdownParent: $("#edit"),
            ajax: {
                delay: 250,
                url: "/api/admin/cases/items/all",
                type: "GET",
                data: function (params) {
                    const query = {
                        search: params.term,
                        page: params.page || 1,
                    };

                    return query;
                },
                processResults: function (data, params) {
                    return {
                        results: data.results,
                        pagination: {
                            more: data.more,
                        },
                    };
                },
            },
        });
    },
};
</script>
