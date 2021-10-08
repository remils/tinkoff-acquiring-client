# Tinkoff acquiring client

PHP client for Tinkoff REST API.

## 1 Requirements

- PHP 7.1 or latter

## 2 Install

```sh
composer require 'sergey-zatulivetrov/tinkoff-acquiring-client'
```

## 3 Client

**Methods**

Return|Name|Description
---|---|---
array|init([Init](#init) $data)|Creation of order
array|finishAuthorize([FinishAuthorize](#finishauthorize) $data)|Confirms the payment of the transfer of details and write-off / blocking funds
array|confirm([Confirm](#confirm) $data)|Confirmation of payment
array|cancel([Cancel](#cancel) $data)|Cancellation
array|getState([GetState](#getstate) $data)|Get the status of payment
array|resend([Resend](#resend) $data)|Sending lackless notifications
array|submit3DSAuthorization([Submit3DSAuthorization](#submit3dsauthorization) $data)|Carries out test results 3-D Secure
array|sendClosingReceipt([SendClosingReceipt](#sendclosingreceipt) $data)|Sends a closing check to the cashier
array|charge([Charge](#charge) $data)|Performs auto plates
array|addCustomer([AddCustomer](#addcustomer) $data)|Registers the buyer and its data in the seller's system
array|getCustomer([GetCustomer](#getcustomer) $data)|Returns the buyer's data
array|removeCustomer([RemoveCustomer](#removecustomer) $data)|Removes the registered buyer data
array|getCardList([GetCardList](#getcardlist) $data)|Returns a list of saved registered buyer maps
array|removeCard([RemoveCard](#removecard) $data)|Removes a tied buyer card

## 4 Data

### Init

**Properties**

Type|Name|Description
---|---|---
string|$TerminalKey|Terminal identifier. Issued to the seller by the bank when opening the terminal
int|$Amount|The amount in kopecks
string|$OrderId|Order ID in the seller's system
string|$IP|Buyer's IP address
string|$Description|Description of the order
string|$Language|Payment form language
string|$Recurrent|Parent payment ID
string|$CustomerKey|Buyer's identifier in the seller's system. Passed along with the CardId parameter
string|$RedirectDueDate|Link lifetime (no more than 90 days)
string|$NotificationURL|Address for receiving http notifications
string|$SuccessURL|Success page
string|$FailURL|Error page
string|$PayType|Payment type
[Receipt](#receipt)|$Receipt|Receipt data array
array|$DATA|Additional payment parameters in the "key" format: "value" (no more than 20 pairs)
string|$Token|Token

**Methods**

Return|Name|Description
---|---|---
void|generateToken(string $password)|Token generation

### FinishAuthorize

**Properties**
Type|Name|Description
---|---|---
string|$TerminalKey|Terminal ID. It is issued to the Seller by the Bank at the Terminal Institution
string|$CardData|Encrypted card data
string|$EncryptedPaymentData|Card data
int|$Amount|Amount in kopecks
array|$DATA|Advanced payment options in "Key" format: "Value" (no more than 20 pairs)
string|$InfoEmail|Email to send payment information
string|$IP|IP address client
int|$PaymentId|A unique transaction identifier in the bank system obtained in response to the initiating method
string|$Phone|Phone Client
bool|$SendEmail|True - Send the client information on payment of payment, false - Do not send
string|$Route|Method of payment
string|$Source|Source of payment
string|$Token|Token

**Methods**

Return|Name|Description
---|---|---
void|generateToken(string $password)|Token generation
void|encodeCardData($publicKey, [CardData](#carddata) $cardData)|Encryption data cards

### Cancel

**Properties**
Type|Name|Description
---|---|---
string|$TerminalKey|Terminal ID. It is issued to the Seller by the Bank at the Terminal Institution
int|$PaymentId|Payment Identifier in the Bank System
int|$Amount|Return rate in kopecks
string|$IP|Buyer's IP address
[Receipt](#receipt)|$Receipt|An array of check data
string|$Token|Token

**Methods**

Return|Name|Description
---|---|---
void|generateToken(string $password)|Token generation

### Confirm

**Properties**
Type|Name|Description
---|---|---
string|$TerminalKey|Terminal ID. It is issued to the Seller by the Bank at the Terminal Institution
int|$PaymentId|Payment Identifier in the Bank System
int|$Amount|Amount in kopecks
string|$IP|Buyer's IP address
[Receipt](#receipt)|$Receipt|An array of check data
string|$Token|Token

**Methods**

Return|Name|Description
---|---|---
void|generateToken(string $password)|Token generation

### GetState

**Properties**
Type|Name|Description
---|---|---
string|$TerminalKey|Terminal ID. It is issued to the Seller by the Bank at the Terminal Institution
int|$PaymentId|Payment Identifier in the Bank System
string|$IP|Buyer's IP address
string|$Token|Token

**Methods**

Return|Name|Description
---|---|---
void|generateToken(string $password)|Token generation

### Resend

**Properties**
Type|Name|Description
---|---|---
string|$TerminalKey|Terminal ID. It is issued to the Seller by the Bank at the Terminal Institution
string|$Token|Token

**Methods**

Return|Name|Description
---|---|---
void|generateToken(string $password)|Token generation

### Submit3DSAuthorization

**Properties**
Type|Name|Description
---|---|---
string|$MD|Unique transaction identifier in the bank system
string|$PaRes|Encrypted string containing results 3-D Secure authentication
int|$PaymentId|Unique transaction identifier in the bank system
string|$TerminalKey|Terminal ID, issued to the seller by the bank
string|$Token|Token

**Methods**

Return|Name|Description
---|---|---
void|generateToken(string $password)|Token generation

### SendClosingReceipt

**Properties**
Type|Name|Description
---|---|---
string|$TerminalKey|Terminal ID. It is issued to the Seller by the Bank at the Terminal Institution
int|$PaymentId|Payment Identifier in the Bank System
[Receipt](#receipt)|$Receipt|An array of check data
string|$Token|Token

**Methods**

Return|Name|Description
---|---|---
void|generateToken(string $password)|Token generation

### Charge

**Properties**
Type|Name|Description
---|---|---
string|$TerminalKey|Terminal ID. It is issued to the Seller by the Bank at the Terminal Institution
int|$PaymentId|Payment Identifier in the Bank System
int|$RebillId|Identifier auto-payment
bool|$SendEmail|Obtaining a buyer of email notifications
string|$InfoEmail|Email buyer
string|$IP|Buyer's IP address
string|$Token|Token

**Methods**

Return|Name|Description
---|---|---
void|generateToken(string $password)|Token generation

### AddCustomer

**Properties**
Type|Name|Description
---|---|---
string|$TerminalKey|Terminal ID. It is issued to the Seller by the Bank at the Terminal Institution
string|$CustomerKey|Buyer identifier in the seller
string|$Email|Email buyer
string|$Phone|Phone buyer in format +71234567890
string|$IP|Buyer's IP address
string|$Token|Token

**Methods**

Return|Name|Description
---|---|---
void|generateToken(string $password)|Token generation

### GetCustomer

**Properties**
Type|Name|Description
---|---|---
string|$TerminalKey|Terminal ID. It is issued to the Seller by the Bank at the Terminal Institution
string|$CustomerKey|Buyer identifier in the seller
string|$IP|Buyer's IP address
string|$Token|Token

**Methods**

Return|Name|Description
---|---|---
void|generateToken(string $password)|Token generation

### RemoveCustomer

**Properties**
Type|Name|Description
---|---|---
string|$TerminalKey|Terminal ID. It is issued to the Seller by the Bank at the Terminal Institution
string|$CustomerKey|Buyer identifier in the seller
string|$IP|Buyer's IP address
string|$Token|Token

**Methods**

Return|Name|Description
---|---|---
void|generateToken(string $password)|Token generation

### GetCardList

**Properties**
Type|Name|Description
---|---|---
string|$TerminalKey|Terminal ID. It is issued to the Seller by the Bank at the Terminal Institution
string|$CustomerKey|Buyer identifier in the seller
string|$IP|Buyer's IP address
string|$Token|Token

**Methods**

Return|Name|Description
---|---|---
void|generateToken(string $password)|Token generation

### RemoveCard

**Properties**
Type|Name|Description
---|---|---
string|$TerminalKey|Terminal ID. It is issued to the Seller by the Bank at the Terminal Institution
string|$CustomerKey|Buyer identifier in the seller
string|$CardId|Card ID in the Bank System
string|$IP|Buyer's IP address
string|$Token|Token

**Methods**

Return|Name|Description
---|---|---
void|generateToken(string $password)|Token generation

### Receipt

**Properties**

Type|Name|Description
---|---|---
string|$Email|Buyer email
string|$Phone|Buyer's phone number
string|$EmailCompany|Seller Email
string|$Taxation|Tax system
[Item[]](#item)|$Items|Array of check items with information about goods
[Payments](#payments)|$Payments|Object with information about the types of payment amount

**Methods**

Return|Name|Description
---|---|---
void|initItems(int $count)|Generation of an empty array of check positions
Item|getItem()|Conclusion of check position

### Item

**Properties**

Type|Name|Description
---|---|---
string|$Name|Name of product
float|$Quantity|Number or weight of the goods
int|$Amount|Cost of goods in kopecks
int|$Price|Price per unit of goods in kopecks
string|$PaymentMethod|Sign of payment method
string|$PaymentObject|Sign of the subject of the calculation
string|$Tax|VAT rate
string|$Ean13|Barcode in the required format
[AgentData](#agentdata)|$AgentData|Agent data
[SupplierInfo](#supplierinfo)|$SupplierInfo|Payment Agent Supplier Data

### AgentData

**Properties**

Type|Name|Description
---|---|---
string|$AgentSign|Sign of agent
string|$OperationName|The name of the operation
string[]|$Phones|Phones of the payment agent
string[]|$ReceiverPhones|Phone operator for receiving payments
string[]|$TransferPhones|Phones Translation Operator
string|$OperatorName|Name of transformation operator
string|$OperatorAddress|Alternator address translation
string|$OperatorInn|Inn Translation Operator

### SupplierInfo

**Properties**

Type|Name|Description
---|---|---
string[]|$Phones|Phone supplier
string|$Name|Supplier name
string|$Inn|TIN supplier

### Payments

**Properties**

Type|Name|Description
---|---|---
int|$Cash|Payment type "Cash". Amount to be paid in kopecks, no more than 14 digits
int|$Electronic|Payment type "Non-cash"
int|$AdvancePayment|Payment type "Advance payment (Advance payment)"
int|$Credit|Payment type "Postpaid (Credit)"
int|$Provision|Payment type "Other form of payment"

### CardData

Type|Name|Description
---|---|---
int|$PAN|Card number
string|$ExpDate|Month and year of the duration of the card. In MMYY format
string|$CardHolder|Name and surname card holder as on map
string|$CVV|Protection code
string|$ECI|Electronic Commerce Indicator. The indicator showing the degree of protection used in providing the buyer of its TSP data. Used and is required for Apple Pay or Google Pay
string|$CAVV|Cardholder Authentication Verification Value or Accountholder Authentication Value Used and is required for Apple Pay or Google Pay

## 5 Constants

### AgentSign

Name|Description
---|---
BANK_PAYING_AGENT|Bank payment agent
BANK_PAYING_SUBAGENT|Bank payment subagent
PAYING_AGENT|Payment Agent
PAYING_SUBAGENT|Payment Subagent
ATTORNEY|Attorney
COMMISSION_AGENT|Commissioner
ANOTHER|Another type of agent

### Language

Name|Description
---|---
RU|Russian
EN|English

### PaymentMethod

Name|Description
---|---
FULL_PREPAYMENT|Prepay 100%
PREPAYMENT|Prepayment
ADVANCE|Avanc
FULL_PAYMENT|Full calculation
PARTIAL_PAYMENT|Partial calculation and credit
CREDIT|Transfer to Credit
CREDIT_PAYMENT|Payment of credit

### PaymentObject

Name|Description
---|---
COMMODITY|Product
EXCISE|Crossing commodity
JOB|Work
SERVICE|Service
GAMBLING_BET|Betting a gambling
GAMBLING_PRIZE|Gambling win
LOTTERY|Lottery ticket
LOTTERY_PRIZE|Winning lottery
INTELLECTUAL_ACTIVITY|Providing Intellectual Activities
PAYMENT|Payment
AGENT_COMMISSION|Agent's commission
COMPOSITE|Composite subject of calculation
ANOTHER|Other subject of calculation

### PayType

Name|Description
---|---
O|Singadail payment
T|Double-step payment

### Route

Name|Description
---|---
ACQ|ACQ

### Source

Name|Description
---|---
CARDS|Cards
APPLE_PAY|ApplePay
GOOGLE_PAY|GooglePay

### Taxation

Name|Description
---|---
OSN|General
USN_INCOME|Simplified (income)
USN_INCOME_OUTCOME|Simplified (income minus costs)
PATENT|Patent
ENVD|A single tax on imputed income
ESN|Single agricultural tax

### Vat

Name|Description
---|---
NONE|None
VAT0|0%
VAT10|10%
VAT20|20%
VAT110|10/110
VAT120|20/120

## 6 Example

```php
use SergeyZatulivetrov\TinkoffAcquiring\Client;
use SergeyZatulivetrov\TinkoffAcquiring\Constants\PaymentMethod;
use SergeyZatulivetrov\TinkoffAcquiring\Constants\PaymentObject;
use SergeyZatulivetrov\TinkoffAcquiring\Constants\Taxation;
use SergeyZatulivetrov\TinkoffAcquiring\Constants\Vat;
use SergeyZatulivetrov\TinkoffAcquiring\Data\Init;
use SergeyZatulivetrov\TinkoffAcquiring\Data\Receipt;

$data = new Init();
$data->TerminalKey = "TinkoffBankTest";
$data->Amount = "140000";
$data->OrderId = "21050";
$data->Description = "Gift card for 1400.00 rubles";
$data->DATA = [
    "Phone" => "+71234567890",
    "Email" => "a@test.com"
];
$data->Receipt = new Receipt();
$data->Receipt->Email = "a@test.ru";
$data->Receipt->Phone = "+79031234567";
$data->Receipt->EmailCompany = "b@test.ru";
$data->Receipt->Taxation = Taxation::OSN;

$data->Receipt->initItems(3);

$data->Receipt->getItem(0)->Name = "Product name 1.";
$data->Receipt->getItem(0)->Price = 10000;
$data->Receipt->getItem(0)->Quantity = 1.00;
$data->Receipt->getItem(0)->Amount = 10000;
$data->Receipt->getItem(0)->PaymentMethod = PaymentMethod::FULL_PREPAYMENT;
$data->Receipt->getItem(0)->PaymentObject = PaymentObject::COMMODITY;
$data->Receipt->getItem(0)->Tax = Vat::VAT10;
$data->Receipt->getItem(0)->Ean13 = "0123456789";

$data->Receipt->getItem(1)->Name = "Product Name 2.";
$data->Receipt->getItem(1)->Price = 20000;
$data->Receipt->getItem(1)->Quantity = 2.00;
$data->Receipt->getItem(1)->Amount = 40000;
$data->Receipt->getItem(1)->PaymentMethod = PaymentMethod::PREPAYMENT;
$data->Receipt->getItem(1)->PaymentObject = PaymentObject::SERVICE;
$data->Receipt->getItem(1)->Tax = Vat::VAT20;

$data->Receipt->getItem(2)->Name = "Product Name 3.";
$data->Receipt->getItem(2)->Price = 30000;
$data->Receipt->getItem(2)->Quantity = 3.00;
$data->Receipt->getItem(2)->Amount = 90000;
$data->Receipt->getItem(2)->Tax = Vat::VAT10;


$client = new Client();
$res = $client->init($data);

var_dump($res);
```

## 7 License

Copyright (c) Zatulivetrov Sergey. Distributed under the MIT.
