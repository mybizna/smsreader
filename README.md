# Mybizna ERP SMS Sending Module
This module allows users of the Mybizna ERP platform to easily send SMS messages to customers and employees directly from the platform.



## Getting Started
- Sign up for an SMS gateway service such as Twilio and obtain an API key.
- Configure the API key within the Mybizna ERP platform.
- Create groups of contacts within the "Contacts" section of the Mybizna ERP platform to send SMS messages to specific groups of people.
- Use the "SMS" section of the Mybizna ERP platform to compose and send messages to individual contacts or groups.

## Requirements
Mybizna ERP version 1.0 or above

## An SMS gateway service with an API key
Usage
To use this module, you need to have an instance of Mybizna ERP and API key for a SMS gateway service.
This module is compatible with Mybizna ERP version 1.0 and above
You can access the source code of the module on the company's Github repository.
## Support
If you have any questions or need assistance, please contact our support team. We're always happy to help!

## Contributing
If you're interested in contributing to this project, please reach out to the team. We welcome pull requests and bug reports.

## License
This project is licensed under the GPL-3.0-or-later.

## Note
Make sure to check the pricing and SMS message limits of your SMS gateway service.
Feel free to make any suggestions or improvements to this module.

## SMS Parser
Examples of SMSes parsed.
```
PD77K63BLB Confirmed.You have received Ksh8,000.00 from JONH  MWANGI 0732329393 on 7/4/23 at 4:30 PM  New M-PESA balance is Ksh140,753.32. SAFARICOM ONLY CALLS YOU FROM 0722000000. To reverse, forward this message to 456.

PD77K63BLBX Confirmed. on 12/11/09 at 5:34 AM Ksh100 received from Maina Ben 0712121212 Account Number 123ABC New Utility balance
```

How to test SMSes.

```
curl -X 'POST' 'http://127.0.0.1:8000/smsreader/incoming' \
     -H 'content-type: application/json; charset=utf-8' \
     -d $'{"from":"0713034569","text":"XXXYYYZZZ9 Confirmed. Ksh80.00 sent to MSEE WA CHIPO 0704444444 on 12/4/21 at 1:57 PM. New M-PESA","sentStamp":"1680492543","receivedStamp":"1680492543","sim":"SIM1"}'
  ```
