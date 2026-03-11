<template>
    <div>
        <div class="kt-subheader kt-grid__item" id="kt_subheader">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">Логи</h3>
            </div>
        </div>

        <div
            class="kt-content kt-grid__item kt-grid__item--fluid"
            id="kt_content"
        >
            <div class="kt-portlet kt-portlet--mobile">
                <div class="kt-portlet__head kt-portlet__head--lg">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">Список логов</h3>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <table
                        class="table table-striped- table-bordered table-hover table-checkable"
                        id="logs"
                    >
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Дата</th>
                                <th>Пользователь</th>
                                <th>Действие пользователя</th>
                                <th>Влияние на пользователя</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="log in logs" :key="log.id">
                                <td>
                                    {{ log.id !== null ? log.id : "нет" }}
                                </td>
                                <td>
                                    {{
                                        log.created_at !== null
                                            ? log.created_at
                                            : "нет"
                                    }}
                                </td>
                                <td>
                                    <router-link
                                        :to="'/user/' + log.user_id"
                                        target="_blank"
                                    >
                                        Профиль
                                    </router-link>
                                </td>
                                <td v-html="log.action"></td>
                                <td>
                                    {{
                                        log.impact !== null ? log.impact : "нет"
                                    }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
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
            logs: [],
        };
    },
    methods: {
        async load() {
            const request = await this.axios.post("/logs/load");

            this.logs = request.data;


            const table = $("#logs");

            table.DataTable().destroy();
            this.$nextTick(function () {
                table.DataTable();
            });
        },
    },
    mounted() {
        this.load();
    },
};
</script>
