<template>
    <div>
        <div class="kt-subheader kt-grid__item" id="kt_subheader">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">Кейсы</h3>
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
                            Кейсы
                            <input
                                ref="editImage"
                                hidden
                                type="file"
                                class="form-control-file"
                                @change="editImage($event)"
                            />
                            <input
                                ref="newImage"
                                hidden
                                type="file"
                                class="form-control-file"
                                @change="newImage($event)"
                            />
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
                        id="cases"
                    >
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Изображение</th>
                                <th>Категория</th>
                                <th>Название</th>
                                <td>Стоимость</td>
                                <th>Открытий</th>
                                <th>Профит</th>
                                <th>Тип</th>
                                <th>Действия</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="box in cases">
                                <td>{{ box.id }}</td>
                                <td>
                                    <img
                                        :src="'/assets/img/cases/' + box.image"
                                        alt="Кейс"
                                        class="img-fluid"
                                        style="
                                            max-width: 75px;
                                            max-height: 75px;
                                        "
                                    />
                                </td>
                                <td>
                                    {{
                                        box.category !== null
                                            ? box.category.name
                                            : "Нет категории"
                                    }}
                                </td>
                                <td>{{ box.name }}</td>
                                <td>
                                    {{ box.price }}<i class="la la-rub"></i>
                                </td>
                                <td>{{ box.opened }}</td>
                                <td>
                                    {{
                                        new Intl.NumberFormat("ru").format(
                                            box.profit
                                        )
                                    }}<i class="la la-rub"></i>
                                </td>
                                <td>
                                    {{
                                        box.type === "default"
                                            ? "Обычный"
                                            : box.type === "free"
                                            ? "Бесплатный"
                                            : box.type
                                    }}
                                </td>

                                <td>
                                    <a
                                        class="btn btn-sm btn-clean btn-icon btn-icon-md"
                                        @click="edit(box.id)"
                                        title="Редактировать"
                                    >
                                        <i class="la la-edit"></i>
                                    </a>
                                    <router-link
                                        tag="a"
                                        :to="{
                                            name: 'cases.items',
                                            params: { id: box.id },
                                        }"
                                        class="btn btn-sm btn-clean btn-icon btn-icon-md"
                                        title="Предметы"
                                    >
                                        <i class="la la-briefcase"></i>
                                    </router-link>
                                    <a
                                        class="btn btn-sm btn-clean btn-icon btn-icon-md"
                                        @click="deleteCase(box.id)"
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
                            Создать кейс
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
                                    <label>Название:</label>
                                    <input
                                        type="text"
                                        v-model="newCase.name"
                                        placeholder="Армейское"
                                        class="form-control"
                                    />
                                </div>
                                <div class="form-group col-lg-6">
                                    <label>Название для ссылки:</label>
                                    <input
                                        type="text"
                                        v-model="newCase.url"
                                        placeholder="bestcase"
                                        class="form-control"
                                    />
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-lg-6">
                                    <label>Название англ.:</label>
                                    <input
                                        type="text"
                                        v-model="newCase.name_en"
                                        placeholder="Армейское"
                                        class="form-control"
                                    />
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-lg-12">
                                    <label>Цена:</label>
                                    <input
                                        type="number"
                                        v-model="newCase.price"
                                        placeholder="29"
                                        class="form-control"
                                    />
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-lg-12">
                                    <label
                                        >Минимальный депозит (только для
                                        бесплатных):</label
                                    >
                                    <input
                                        type="number"
                                        v-model="newCase.min_dep"
                                        placeholder="100"
                                        class="form-control"
                                    />
                                </div>
                            </div>
                            <div class="form-group d-flex flex-column">
                                <label>Изображение:</label>
                                <button
                                    @click="$refs.newImage.click()"
                                    class="btn btn-success"
                                >
                                    {{
                                        newCase.image === null
                                            ? "Выбрать"
                                            : "Картинка выбрана"
                                    }}
                                </button>
                            </div>
                            <div class="form-group">
                                <label>Категория:</label>
                                <select
                                    v-model="newCase.category_id"
                                    class="form-control"
                                >
                                    <option value="">Нет категории</option>
                                    <option
                                        v-for="category in categories"
                                        :value="category.id"
                                    >
                                        {{ category.name }}
                                    </option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Тип</label>
                                <select
                                    v-model="newCase.type"
                                    class="form-control"
                                    @change="debugType"
                                >
                                    <option value="default">Обычный</option>
                                    <option value="free">Бесплатный</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Активный</label>
                                <select
                                    v-model="newCase.is_show"
                                    class="form-control"
                                >
                                    <option value="1">Да</option>
                                    <option value="0">Нет</option>
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
                                @click="create"
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
                            Редактировать кейс
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
                                    <label>Название:</label>
                                    <input
                                        type="text"
                                        v-model="editCase.name"
                                        placeholder="Армейское"
                                        class="form-control"
                                    />
                                </div>
                                <div class="form-group col-lg-6">
                                    <label>Название для ссылки:</label>
                                    <input
                                        type="text"
                                        v-model="editCase.url"
                                        placeholder="bestcase"
                                        class="form-control"
                                    />
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-lg-6">
                                    <label>Название англ.:</label>
                                    <input
                                        type="text"
                                        v-model="editCase.name_en"
                                        placeholder="Армейское"
                                        class="form-control"
                                    />
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-lg-12">
                                    <label>Цена:</label>
                                    <input
                                        type="number"
                                        v-model="editCase.price"
                                        placeholder="29"
                                        class="form-control"
                                    />
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-lg-12">
                                    <label
                                        >Минимальный депозит (только для
                                        бесплатных):</label
                                    >
                                    <input
                                        type="number"
                                        v-model="editCase.min_dep"
                                        placeholder="100"
                                        class="form-control"
                                    />
                                </div>
                            </div>
                            <div class="form-group d-flex flex-column">
                                <label>Изображение:</label>
                                <button
                                    @click="$refs.editImage.click()"
                                    class="btn btn-success"
                                >
                                    {{
                                        editCase.image === null
                                            ? "Выбрать"
                                            : "Картинка выбрана"
                                    }}
                                </button>
                            </div>
                            <div class="form-group">
                                <label>Категория:</label>
                                <select
                                    v-model="editCase.category_id"
                                    class="form-control"
                                >
                                    <option value="">Нет категории</option>
                                    <option
                                        :selected="
                                            editCase.category_id === category.id
                                        "
                                        v-for="category in categories"
                                        :value="category.id"
                                    >
                                        {{ category.name }}
                                    </option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Тип</label>
                                <select
                                    v-model="editCase.type"
                                    class="form-control"
                                >
                                    <option
                                        :selected="editCase.type === 'default'"
                                        value="default"
                                    >
                                        Обычный
                                    </option>
                                    <option
                                        :selected="editCase.type === 'free'"
                                        value="free"
                                    >
                                        Бесплатный
                                    </option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Активный</label>
                                <select
                                    v-model="editCase.is_show"
                                    class="form-control"
                                >
                                    <option
                                        :selected="editCase.is_show === 1"
                                        value="1"
                                    >
                                        Да
                                    </option>
                                    <option
                                        :selected="editCase.is_show === 0"
                                        value="0"
                                    >
                                        Нет
                                    </option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Профит</label>
                                <input
                                    type="number"
                                    v-model="editCase.profit"
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
            cases: [],
            categories: [],
            editCase: {
                category_id: "",
                name: "",
                name_en: "",
                image: "",
                url: "",
                max_opened: "",
                price: "",
                price_old: "",
                type: "default",
                is_show: 0,
                experience: 0,
                min_dep: "",
            },
            newCase: {
                category_id: "",
                name: "",
                name_en: "",
                image: "",
                url: "",
                max_opened: "",
                price: "",
                price_old: "",
                type: "default",
                is_show: 1,
                experience: 0,
                min_dep: "",
            },
        };
    },
    methods: {
        load() {
            this.axios.get("/cases/load").then((res) => {
                this.cases = res.data.cases;
                this.categories = res.data.categories;

                const table = $("#cases");
                table.DataTable().destroy();
                this.$nextTick(function () {
                    table.DataTable();
                });
            });
        },
        create() {
            let data = new FormData();
            for (let key in this.newCase) {
                data.append(key, this.newCase[key]);
            }
            const config = {
                headers: {
                    "content-type": "multipart/form-data",
                },
            };

            this.axios.post("/cases/create", data, config).then((res) => {
                let result = res.data;

                if (result.success) {
                    this.$toast.success(result.message);

                    $("#new").modal("hide");

                    this.newCase = {
                        category_id: "",
                        name: "",
                        name_en: "",
                        image: "",
                        url: "",
                        max_opened: "",
                        price: "",
                        price_old: "",
                        type: "default",
                        is_show: 1,
                        experience: 0,
                        type: "default",
                        min_dep: "",
                    };

                    this.load();
                }

                if (!result.success) {
                    this.$toast.error(result.message);
                }
            });
        },
        edit(id) {
            this.$root.axios.post("/cases/get", { id: id }).then((res) => {
                let result = res.data;

                if (result.success) {
                    this.editCase = result.box;
                    this.editCase.experience = result.box.exp;
                    this.editCase.image = null;
                    $("#edit").modal("show");
                }

                if (!result.success) {
                    this.$root.$toast.error(result.message);
                }
            });
        },
        saveEdit() {
            let data = new FormData();
            for (let key in this.editCase) {
                if (this.editCase[key] === null) this.editCase[key] = "";
                data.append(key, this.editCase[key]);
            }
            const config = {
                headers: {
                    "content-type": "multipart/form-data",
                },
            };

            this.$root.axios.post("/cases/edit", data, config).then((res) => {
                let result = res.data;

                if (result.success) {
                    $("#edit").modal("hide");
                    this.load();
                    this.$toast.success(result.message);
                }

                if (!result.success) {
                    this.$toast.error(result.message);
                }
            });
        },
        deleteCase(id) {
            this.axios.post("/cases/delete", { id: id }).then((res) => {
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
        debugType() {
            console.log("Тип кейса:", this.newCase.type);
        },
        editImage(e) {
            console.log(e);
            this.editCase.image = e.target.files[0];
        },
        newImage(e) {
            this.newCase.image = e.target.files[0];
        },
    },
    mounted() {
        this.load();
        this.newCase.image = null;
    },
};
</script>
