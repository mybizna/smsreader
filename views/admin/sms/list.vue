
<template>
    <table-render title="SMS Reader Messaage" :path_param="path_param" :search_fields="search_fields" :model="model"
        :table_fields="table_fields"></table-render>
</template>

<script>

export default {
    data() {
        return {
            path_param: ["smsreader", "sms"],
            model: {
                id: "",
                phone: "",
                message: "",
                date_sent: "",
                params: "",
                gateway_id: "",
                completed: "",
                successful: "",
            },
            search_fields: [
                { type: "text", name: "phone", label: "Phone", ope: "", },
                { type: "text", name: "message", label: "Message", ope: "", },
                { type: "text", name: "date_sent", label: "Date Sent", ope: "", },
                { type: "text", name: "gateway_id", label: "Gateway", ope: "", },
                { type: "text", name: "completed", label: "Completed", ope: "", },
                { type: "text", name: "successful", label: "Successful", ope: "", },
            ],
            table_fields: [
                { text: "Phone", prop: "phone", name: "phone", },
                { text: "Message", prop: "message", name: "message", },
                { text: "Date Sent", prop: "date_sent", name: "date_sent", },
                { text: "Params", prop: "params", name: "params", },
                { text: "Gateway", prop: "gateway_id", name: "gateway_id", },
                { text: "Completed", prop: "completed", name: "completed", },
                { text: "Successful", prop: "successful", name: "successful", },
            ],
        };
    }
};
</script>
