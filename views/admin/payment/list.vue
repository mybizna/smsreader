
<template>
    <table-render :path_param="['smsreader', 'payment']" title="SMS Reader Payment" :table_fields="table_fields">
        
        <template #header>
            <th-render>Phone</th-render>
            <th-render>Code</th-render>
            <th-render>Name</th-render>
            <th-render>Format</th-render>
            <th-render>Sms</th-render>
            <th-render>Partner</th-render>
            <th-render>Amount</th-render>
            <th-render>Account</th-render>
            <th-render>Date Sent</th-render>
            <th-render>Completed</th-render>
            <th-render>Successful</th-render>
        </template>

        <template #body="{ item }">
            <td>{{ item.phone }}</td>
            <td>{{ item.code }}</td>
            <td>{{ item.name }}</td>
            <td>{{ item.format_id }}</td>
            <td>{{ item.sms_id }}</td>
            <td>{{ item.partner_id }}</td>
            <td>{{ item.amount }}</td>
            <td>{{ item.account }}</td>
            <td>{{ item.date_sent }}</td>
            <td>{{ item.completed }}</td>
            <td>{{ item.successful }}</td>
        </template>

    </table-render>
</template>

<script>

export default {
    data() {
        return {
            table_fields: [
                'phone', 'code', 'name', 'format_id', 'sms_id', 'partner_id',
                'amount', 'account', 'date_sent', 'completed', 'successful'
            ],
        };
    }
};
</script>
