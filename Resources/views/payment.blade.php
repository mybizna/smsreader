<div class="sending_direct">

    <h2 class="mb-2 text-md font-semibold text-gray-900 dark:text-white">
        Please follow the steps shown
        below to make your payment by Sending Directly:
    </h2>

    {{ $gateway->instruction }}

    <div style="text-align:center; margin-top:20px;">
        <button id='tillno' type="submit" name="view" value="tillno_{{ $invoice->id }}"
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
            Verify Payment
        </button>
    </div>


</div
