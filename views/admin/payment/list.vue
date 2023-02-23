
<template>
    <table-list title="SMS Reader Payment" :path_param="path_param" :search_fields="search_fields" :model="model"
        :table_fields="table_fields"></table-list>
</template>

<script>

export default {
    data () {
        return {
            path_param: ["smsreader", "payment"],
            model: {
                id: "",
                phone: "",
                code: "",
                name: "",
                format_id: "",
                sms_id: "",
                partner_id: "",
                amount: "",
                account: "",
                date_sent: "",
                completed: "",
                successful: "",
            },
            search_fields: [
                { type: "text", name: "phone", label: "Phone", ope: "", },
                { type: "text", name: "code", label: "Code", ope: "", },
                { type: "text", name: "name", label: "Name", ope: "", },
                { type: "text", name: "format_id", label: "Format", ope: "", },
                { type: "text", name: "sms_id", label: "Sms", ope: "", },
                { type: "text", name: "partner_id", label: "Partner", ope: "", },
                { type: "text", name: "amount", label: "Amount", ope: "", },
                { type: "text", name: "account", label: "Account", ope: "", },
                { type: "text", name: "date_sent", label: "Date Sent", ope: "", },
                { type: "text", name: "completed", label: "Completed", ope: "", },
                { type: "text", name: "successful", label: "Successful", ope: "", },
            ],
            table_fields: [
                { text: "Phone", prop: "phone", name: "phone", },
                { text: "Code", prop: "code", name: "code", },
                { text: "Name", prop: "name", name: "name", },
                { text: "Format", prop: "format_id", name: "format_id", },
                { text: "Sms", prop: "sms_id", name: "sms_id", },
                { text: "Partner", prop: "partner_id", name: "partner_id", },
                { text: "Amount", prop: "amount", name: "amount", },
                { text: "Account", prop: "account", name: "account", },
                { text: "Date Sent", prop: "date_sent", name: "date_sent", },
                { text: "Completed", prop: "completed", name: "completed", },
                { text: "Successful", prop: "successful", name: "successful", },
            ],
        };
    }
};
</script>
