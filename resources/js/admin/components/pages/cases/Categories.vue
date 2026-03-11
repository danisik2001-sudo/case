<template>
    <div>
        <div class="kt-subheader kt-grid__item" id="kt_subheader">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">Категории</h3>
            </div>
        </div>

        <div
            class="kt-content kt-grid__item kt-grid__item--fluid"
            id="kt_content"
        >
            <div class="kt-portlet kt-portlet--mobile">
                <div class="kt-portlet__head kt-portlet__head--lg">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">Список категорий</h3>
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
                        id="categories"
                    >
                        <thead>
                            <tr>
                                <th>Название</th>
                                <th>Позиция</th>
                                <th>Действия</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="category in categories">
                                <td>{{ category.name }}</td>
                                <td>{{ category.position }}</td>
                                <td>
                                    <a
                                        class="btn btn-sm btn-clean btn-icon btn-icon-md"
                                        @click="edit(category.id)"
                                        title="Редактировать"
                                    >
                                        <i class="la la-edit"></i>
                                    </a>
                                    <a
                                        class="btn btn-sm btn-clean btn-icon btn-icon-md"
                                        @click="del(category.id)"
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
                            Создать категорию
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
                                    v-model="newCategory.name"
                                    class="form-control"
                                />
                            </div>
                            <div class="form-group">
                                <label>Название англ:</label>
                                <input
                                    type="text"
                                    v-model="newCategory.name_en"
                                    class="form-control"
                                />
                            </div>

                            <div class="form-group">
                                <label>Позиция:</label>
                                <input
                                    type="text"
                                    v-model="newCategory.position"
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
                            Изменить категорию
                        </h5>
                        <button
                            type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close"
                        ></button>
                    </div>
                    <form class="kt-form-new">
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Название:</label>
                                <input
                                    type="text"
                                    v-model="editCategory.name"
                                    class="form-control"
                                />
                            </div>
                            <div class="form-group">
                                <label>Название англ:</label>
                                <input
                                    type="text"
                                    v-model="editCategory.name_en"
                                    class="form-control"
                                />
                            </div>

                            <div class="form-group">
                                <label>Позиция:</label>
                                <input
                                    type="text"
                                    v-model="editCategory.position"
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
                                type="button"
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
export default {
    data() {
        return {
            categories: [],
            newCategory: {
                name: null,
                name_en: null,
                position: null,
            },
            editCategory: {
                id: null,
                name: null,
                name_en: null,
                position: null,
            },
        };
    },
    methods: {
        load() {
            this.axios.post("/categories/load").then((res) => {
                this.categories = res.data;

                const table = $("#categories");

                table.DataTable().destroy();
                this.$nextTick(function () {
                    table.DataTable();
                });
            });
        },
        create() {
            this.axios
                .post("/categories/create", { category: this.newCategory })
                .then((res) => {
                    let result = res.data;

                    if (result.success) {
                        this.$toast.success(result.message);
                        $("#new").modal("hide");

                        this.newCategory = {
                            name: null,
                            name_en: null,
                            position: null,
                        };

                        this.load();
                    }

                    if (!result.success) {
                        this.$toast.error(result.message);
                    }
                });
        },
        edit(id) {
            this.axios.post("/categories/get", { id: id }).then((res) => {
                let result = res.data;

                if (result.success) {
                    this.editCategory = result.category;
                    $("#edit").modal("show");
                }

                if (!result.success) {
                    this.$toast.error(result.message);
                }
            });
        },
        saveEdit() {
            console.log(this.editCategory);
            this.axios
                .post("/categories/edit", { category: this.editCategory })
                .then((res) => {
                    let result = res.data;

                    if (result.success) {
                        this.$toast.success(result.message);
                        $("#edit").modal("hide");
                        this.load();
                    }

                    if (!result.success) {
                        this.$toast.error(result.message || "Произошла ошибка");
                    }
                });
        },
        del(id) {
            this.axios.post("/categories/del", { id: id }).then((res) => {
                let result = res.data;

                if (result.success) {
                    this.load();
                    this.$toast.success(result.message);
                }

                if (!result.message) {
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
