
<template>
    <table-render :path_param="['smsreader', 'sms']" title="SMS Reader Messaage" :table_fields="table_fields">

        <template #header>
            <th-render>Phone</th-render>
            <th-render>Message</th-render>
            <th-render>Date Sent</th-render>
            <th-render>Params</th-render>
            <th-render>Gateway</th-render>
            <th-render>Completed</th-render>
            <th-render>Successful</th-render>
        </template>

        <template #body="{ item }">
            <td>{{ item.phone }}</td>
            <td>{{ item.message }}</td>
            <td>{{ item.date_sent }}</td>
            <td>{{ item.params }}</td>
            <td>{{ item.gateway_id }}</td>
            <td class="text-center">
                <btn-status :status="item.completed"></btn-status>
            </td>
            <td class="text-center">
                <btn-status :status="item.successful"></btn-status>
            </td>
        </template>

    </table-render>
</template>

<script>

export default {
    data() {
        return {
            table_fields: ['phone', 'message', 'date_sent', 'params', 'gateway_id', 'completed', 'successful'],
        };
    }
};
</script>
