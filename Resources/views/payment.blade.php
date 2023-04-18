<div class="sending_direct">

    <h2 class="mb-2 text-md font-semibold text-gray-900 dark:text-white">
        Please follow the steps shown
        below to make your payment by Sending Directly:
    </h2>

    {{ $gateway->instruction }}

    <div class="mb-4 text-center">
        <br>
        <label class="block text-gray-700 text-sm font-bold mb-2" for="code_reference">
            Code or Reference No.
        </label>
        <input
            class="shadow appearance-none border rounded w-72 p-2 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            id="code_reference" name="code_reference" type="text" placeholder="Code or Reference No.">
    </div>



    <div style="text-align:center; margin-top:20px;">
        <button id='send_direct_button' type="submit" name="view" value="send_direct_button_{{ $invoice->id }}"
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
            Verify Payment
        </button>
    </div>

    <div style="text-align:center; margin-top:20px;">
        <button id='send_direct_cancel_button' type="submit" name="view"
            value="send_direct_cancel_button_{{ $invoice->id }}"
            class=" text-red-500 font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
            Cancel
        </button>
    </div>

    <input id="code_reference_url" type="hidden" name="code_reference_url"
        value="{{ secure_url(route('smsreader_payment_verification')) }}" />
    <input id="code_reference_isp_access_thankyou" type="hidden" name="code_reference_isp_access_thankyou"
        value="{{ secure_url(route('isp_access_thankyou')) }}" />
    <input id="code_reference_isp_access_canceled" type="hidden" name="code_reference_isp_access_canceled"
        value="{{ secure_url(route('isp_access_canceled')) }}" />

</div>

<script>
    var request_sent = false;

    document.querySelector('#send_direct_button').addEventListener('click', paymentVerification);
    document.querySelector('#send_direct_cancel_button').addEventListener('click', paymentCanceled);

    function paymentCanceled() {
        let canceled = document.querySelector('#code_reference_isp_access_canceled').value;

        window.location.href = canceled;
    }

    function paymentVerification() {

        let code_reference = document.querySelector("#code_reference").value;
        let url = document.querySelector('#code_reference_url').value;
        let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        let invoice_id = document.querySelector('#invoice_id').value;
        let thankyou = document.querySelector('#code_reference_isp_access_thankyou').value;

        if (code_reference == '') {
            alert('Code Reference is empty. ');
            return;
        }

        fetch(url, {
                headers: {
                    "Content-Type": "application/json",
                    "Accept": "application/json, text-plain, */*",
                    "X-Requested-With": "XMLHttpRequest",
                    "X-CSRF-TOKEN": token
                },
                method: 'post',
                credentials: "same-origin",
                body: JSON.stringify({
                    code_reference: code_reference,
                    invoice_id: invoice_id,
                })
            })
            .then(response => response.json())
            .then((data) => {
                if (data.status) {
                    window.location.href = thankyou;
                } else {
                    alert(data.message);
                }
            })
            .catch(function(error) {
                console.log(error);
            });
    }
</script>
