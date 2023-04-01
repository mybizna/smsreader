
<template>
    <table-render :path_param="['smsreader', 'requests']" title="SMS Reader Messaage" :table_fields="table_fields">

        <template #header>
            <th-render>Phone</th-render>
            <th-render>Message</th-render>
            <th-render>Date Sent</th-render>
            <th-render>Payment</th-render>
        </template>
        
        <template #body="{ item }">
            <td>{{ item.phone }}</td>
            <td>{{ item.message }}</td>
            <td>{{ item.date_sent }}</td>
            <td>{{ item.payment_id }}</td>
        </template>

    </table-render>
</template>

<script>

export default {
    data() {
        return {
            table_fields: ['payment_id', 'phone', 'message', 'date_sent'],
        };
    }
};
</script>
