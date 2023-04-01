
<template>
    <table-render :path_param="['smsreader', 'account']" title="SMS Reader Messaage" :table_fields="table_fields"
        :setting="{ hide_delete_button: true }">

        <template #header>
            <th-render>Partner</th-render>
            <th-render>TXN</th-render>
            <th-render>Account</th-render>
        </template>
        <template #body="{ item }">
            <td>{{ item.partner_id }}</td>
            <td>{{ item.txn }}</td>
            <td>{{ item.account }}</td>
        </template>

    </table-render>
</template>

<script>

export default {
    data() {
        return {
            table_fields: ['partner_id', 'txn', 'account'],
        };
    }
};
</script>
