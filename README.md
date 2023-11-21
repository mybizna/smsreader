# Mybizna ERP SMS Sending Module

This is a SMS reader application written in PHP that is part of the MyBizna ERP system. The application is designed to parse incoming SMS messages and extract information related to payments and tickets. The extracted information is then processed and stored in the ERP system for easy viewing and analysis.

## Installation

```
composer require mybizna/smsreader
```

## Features
- Parses incoming SMS messages to extract payment and ticket information.
- Supports multiple payment methods, including bank transfers and mobile payments.
- Automatically organizes extracted information into a tabular format for easy viewing and analysis
- Provides basic visualizations of payment and ticket data

## Requirements
Mybizna ERP version 1.0 or above

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

```
   curl -X 'POST' 'http://127.0.0.1:8000/smsreader/incoming' \
     -H 'content-type: application/json; charset=utf-8' \
     -d $'{"from":"0713034569","text":"XXXYYYZZZ9 Confirmed.You have received Ksh80.00 from MSEE WA CHIPO 0704444444 on 12/4/21 at 1:57 PM New M-PESA","sentStamp":"1680492543","receivedStamp":"1680492543","sim":"SIM1"}' 
```