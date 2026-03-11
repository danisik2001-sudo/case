<template>
    <div>
        <div class="kt-subheader kt-grid__item" id="kt_subheader">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">Призы</h3>
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
                            Призы в календаре
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
                        id="calendars"
                    >
                        <thead>
                            <tr>
                                <th>День</th>
                                <th>Бонус на баланс</th>
                                <th>Бесплатный кейс</th>
                                <th>Бесплатный скин</th>
                                <th>Промокод</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                                v-for="calendar in calendars"
                                :key="calendar.id"
                            >
                                <td>
                                    {{
                                        calendar.day !== null
                                            ? calendar.day
                                            : "нет"
                                    }}
                                </td>
                                <td>
                                    {{
                                        calendar.bonus_balance !== null
                                            ? calendar.bonus_balance
                                            : "нет"
                                    }}
                                </td>
                                <td>
                                    {{
                                        calendar.case_id !== null
                                            ? calendar.case_id
                                            : "нет"
                                    }}
                                </td>
                                <td>
                                    {{
                                        calendar.item_id !== null
                                            ? calendar.item_id
                                            : "нет"
                                    }}
                                </td>
                                <td>
                                    {{
                                        calendar.promocode_id !== null
                                            ? calendar.promocode_id
                                            : "нет"
                                    }}
                                </td>
                                <td>
                                    <a
                                        class="btn btn-sm btn-clean btn-icon btn-icon-md"
                                        v-on:click="edit(calendar.id)"
                                        title="Редактировать"
                                    >
                                        <i class="la la-edit"></i>
                                    </a>
                                    <a
                                        class="btn btn-sm btn-clean btn-icon btn-icon-md"
                                        v-on:click="del(calendar.id)"
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
                            Создать бонусный день
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
                                <label>День:</label>
                                <input
                                    type="text"
                                    v-model="newCalendar.day"
                                    class="form-control"
                                />
                            </div>

                            <div class="form-group">
                                <label>Бонус на баланс:</label>
                                <input
                                    type="text"
                                    v-model="newCalendar.bonus_balance"
                                    class="form-control"
                                />
                            </div>
                            <div class="form-group">
                                <label>Бесплатный кейс:</label>
                                <input
                                    type="text"
                                    v-model="newCalendar.case_id"
                                    class="form-control"
                                />
                            </div>
                            <div class="form-group">
                                <label>Бесплатный предмет:</label>
                                <input
                                    type="text"
                                    v-model="newCalendar.item_id"
                                    class="form-control"
                                />
                            </div>

                            <div class="form-group">
                                <label>Промокод</label>
                                <input
                                    type="number"
                                    v-model="newCalendar.promocode_id"
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
                                <label>День:</label>
                                <input
                                    type="text"
                                    v-model="editCalendar.day"
                                    :placeholder="
                                        editCalendar.day !== null
                                            ? editCalendar.day
                                            : 'нет'
                                    "
                                    class="form-control"
                                />
                            </div>

                            <div class="form-group">
                                <label>Бонус на баланс:</label>
                                <input
                                    type="text"
                                    v-model="editCalendar.bonus_balance"
                                    :placeholder="
                                        editCalendar.bonus_balance !== null
                                            ? editCalendar.bonus_balance
                                            : 'нет'
                                    "
                                    class="form-control"
                                />
                            </div>
                            <div class="form-group">
                                <label>Бесплатный кейс:</label>
                                <input
                                    type="text"
                                    v-model="editCalendar.case_id"
                                    :placeholder="
                                        editCalendar.case_id !== null
                                            ? editCalendar.case_id
                                            : 'нет'
                                    "
                                    class="form-control"
                                />
                            </div>
                            <div class="form-group">
                                <label>Бесплатный предмет:</label>
                                <input
                                    type="text"
                                    v-model="editCalendar.item_id"
                                    :placeholder="
                                        editCalendar.item_id !== null
                                            ? editCalendar.item_id
                                            : 'нет'
                                    "
                                    class="form-control"
                                />
                            </div>

                            <div class="form-group">
                                <label>Промокод</label>
                                <input
                                    type="number"
                                    v-model="editCalendar.promocode_id"
                                    :placeholder="
                                        editCalendar.promocode_id !== null
                                            ? editCalendar.promocode_id
                                            : 'нет'
                                    "
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
            calendars: [],
            newCalendar: {
                day: null,
                bonus_balance: null,
                case_id: null,
                item_id: null,
                promocode_id: null,
            },
            editCalendar: {
                day: null,
                bonus_balance: null,
                case_id: null,
                item_id: null,
                promocode_id: null,
            },
        };
    },
    methods: {
        async load() {
            const request = await this.axios.post("/calendar/load");

            this.calendars = request.data;

            const table = $("#calendars");

            table.DataTable().destroy();
            this.$nextTick(function () {
                table.DataTable();
            });
        },
        async create() {
            try {
                const response = await this.axios.post("/calendar/create", {
                    calendar: this.newCalendar,
                });

                const result = response.data;

                this.$toast.success(result.message);

                $("#new").modal("hide");

                this.newCalendar = {
                    day: null,
                    bonus_balance: null,
                    case_id: null,
                    item_id: null,
                    promocode_id: null,
                };

                this.load();
            } catch (error) {
                console.error("Error creating promocode:", error);
                this.$toast.error("Failed to create promocode.");
            }
        },

        async edit(id) {
            const request = await this.axios.post("/calendar/get", {
                id: id,
            });
            const data = request.data;


            if (data.success) {
                this.editCalendar = request.data.calendar;
                $("#edit").modal("show");
            } else {
                this.$toast.success("Ошибка получения данных");
            }
        },
        async saveEdit() {
            const request = await this.axios.post("/calendar/edit", {
                calendar: this.editCalendar,
            });
            const data = request.data;


            if (data && data.message) {
                this.$toast.success(data.message);
            } else {
                console.error("Ошибка получения сообщения");
            }

            this.load();
        },
        async del(id) {
            const request = await this.axios.post("/calendar/del", {
                id: id,
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
