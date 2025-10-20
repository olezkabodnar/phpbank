

SOFWARE TOOLS

Group Project - PART 1






Submitted By: Students Mykhailo Hnylytskyi | Oleh Bodnar | Philip Filippenko

Computing with Games Development/Software Development

Date Submitted: dd/mm/yyyy



# Contents
[1.	Introduction/overview	3](#_toc210129101)

[2.	Functional Components	4](#_toc210129102)

[3.	User Requirements	5](#_toc210129103)

[3.1.	PHP Bank System will manage Accounts	5](#_toc210129104)

[3.2.	PHP Bank will process reservations	5](#_toc210129105)

[3.3.	PHP Bank will be adding founds on own Account	5](#_toc210129106)

[4.	User Stories	6](#_toc210129107)

[4.1.	System Level Use Case Diagram	7](#_toc210129108)

[4.2.	Manage Accounts	8](#_toc210129109)

[4.2.1.	Sign in Account	8](#_toc210129110)

[4.2.2.	Update Account	10](#_toc210129111)

[4.2.3.	Close Account	12](#_toc210129112)

[4.3.	Management	13](#_toc210129113)

[4.3.1.	Check Transaction History	13](#_toc210129114)

[4.3.2.	Enable 2FA	14](#_toc210129115)

[4.4.	Money Transfer	15](#_toc210129116)

[4.4.1.	Add Funds	15](#_toc210129117)

[4.4.2.	Send Money	17](#_toc210129118)

[4.4.3.	Display Confirmation	19](#_toc210129119)

[5.	System Model	21](#_toc210129120)

[5.1.	Level-0 DFD	21](#_toc210129121)

[5.2.	Level-1 DFD	21](#_toc210129122)

[5.3.	Level-2 DFD (Process P1: Title)	21](#_toc210129123)

[5.4.	Level-2 DFD (Process P2: Title)	21](#_toc210129124)

[5.5.	Level-2 DFD (Process P3: Title)	21](#_toc210129125)

[6.	Data Model (UML Class Diagram)	22](#_toc210129126)

[6.1.	Class Diagram	22](#_toc210129127)

[6.2.	Relational Schema	23](#_toc210129128)

[6.3.	Database Schema	23](#_toc210129129)

[7.	Conclusion	25](#_toc210129130)






1. # <a name="_toc526502558"></a><a name="_toc210129101"></a>**Introduction/overview**
Running a modern banking institution comes with its own set of complex challenges. From customer account management to transaction processing to regulatory compliance, it's a demanding process if you don't have the right technological infrastructure in place. The PHP Bank System solves all these needs by providing a comprehensive and secure way of managing daily banking operations, reducing the amount of manual work and increasing overall efficiency and security.

The system focuses on four main areas:

**Account management:** A unified system for the smooth creation, updating and management of customer bank accounts. **Transaction processing:** Tools to monitor and process all types of financial transactions including deposits, withdrawals, and balance inquiries. **Transfer management:** An intuitive workflow for internal and external transfers, cancellations and processing to keep operations running smoothly. **Reporting and analytics:** Features to generate key insights, such as monthly statements and transaction analysis, to help managers make informed decisions and ensure regulatory compliance.

The PHP Bank System is developed on a robust database architecture that maintains and links information on customer accounts, transaction histories and transfer records. This ensures complete accuracy in tracking all financial activities while minimizing the risks associated with manual errors and ensuring regulatory compliance.

This document provides a detailed breakdown of the system's features, capabilities and technical design. It serves as a guide to understanding how the system meets the operational needs of a modern banking institution, whether it's a small community bank or a growing financial services company. By automating key tasks and centralising operations, the PHP Bank System saves time, increases accuracy, ensures compliance and improves the overall experience for both administrators and customers.


1. # <a name="_toc526502559"></a><a name="_toc210129102"></a>**Functional Components**

![](Aspose.Words.5df10e91-2a4a-482a-b320-541595eab007.001.png)

1. # <a name="_toc526502560"></a><a name="_toc210129103"></a>**User Requirements**

1. ## <a name="_toc210129104"></a>**PHP Bank System will manage Accounts**
   1. PHP Bank System will create a customer account.
   1. PHP Bank System will update account details.
   1. PHP Bank System will close an account.

1. ## <a name="_toc526502562"></a><a name="_toc210129105"></a>**PHP Bank will process reservations**
   1. PHP Bank will make a reservation

1. ## <a name="_toc526502563"></a><a name="_toc210129106"></a>**PHP Bank will be adding founds on own Account**
   1. PHP Bank will send money to other Accounts
   1. PHP Bank will display confirmation




1. # <a name="_toc210129107"></a>**User Stories**
**Epic: Account Access and Authentication** 

1. **User Registration**  

   As a New Customer  

   I want to register for online banking 

   So that I can perform the transactions. 

**Acceptance Criteria –** 

- Users must provide valid email, phone number, and personal information 
- System validates email and sends verification code 
- Password must meet security requirements (....) 
- Account creates after email validation 

2. **User Login** 

   As a Registered Customer  

   I want to log in to my account 

   So that I can access my banking account  



**Acceptance Criteria –** 

- Users must provide email and passwords. 
- System validates email and password  
- After 3 failed login attempts, account is locked for 15 minutes  
- Account creates after email validation 



**Epic: Account Management** 

3. **View Account Dashboard**  

   As a customer  

   I want to see my account in dashboard  

   So that I can understand status of my funds  



**Acceptance Criteria –** 

- Customers must be logged in to view dashboards 
- Display all linked accounts (cards, savings, ....) 
- Show balance for each account   
- Display of 5 recent transactions  



4. **View Transaction History**   

   As a customer  

   I want to see all my transaction history  

   So that I can understand my spending/financial situation 



**Acceptance Criteria –** 

- Display transaction details: date, description amount
- Customer can filter transaction by date and type withdrawal, transaction, savings,
- Functionality to download transaction history as PDF file  

**Epic: Money Transfer**  



5. **Internal Transfer**  

   As a customer  

   I want to transfer money between my own accounts   

   So that I can manage my funds  



**Acceptance Criteria –** 

- Customers select source and destination account  
- System validates balances in account and procced transaction 
- Display transfer confirmation notification/message   



6. **External Transfer**  

   As a customer  

   I want to transfer money to other accounts   

   So that I can send money to other people  



**Acceptance Criteria –** 

- Customers must provide other account details   
- System validates account details and both user funds  

Display transfer confirmation notification/message 

1. ## <a name="_toc526502565"></a><a name="_toc210129108"></a>**System Level Use Case Diagram**
Manage Account

Security

Manage Transaction


![](Aspose.Words.5df10e91-2a4a-482a-b320-541595eab007.002.png)















1. ## <a name="_toc210129109"></a>**Manage Accounts**

This module provides functions to manage the lifecycle of customer accounts, including creating new accounts, updating details, and closing accounts that are no longer operational. These features make it super easy to keep the customer account database updated and organised.

1. ### ` `**<a name="_toc210129110"></a>**Sign in Account
This high priority use case allows a customer to create a new account. The process begins when the customer selects "Create Account." The system prompts for required details (name, DOB, phone, email, password), validates them (format, uniqueness, age), and, if valid, creates an account with a unique number. Errors trigger messages and re-entry. Once complete, the account is ready for use.

|**Use Case Name**|Sign in Account||
| :- | :- | :- |
|**Use Case Id**|01||
|**Priority**|High ||
|**Source**|Customer||
|**Primary Business Actor**|||
|**Other Participating Actors**|||
|**Description**|This function records a customer account details in the system.||
|**Preconditions**|||
|**Trigger**|A customer creates a new account in the system.||
|**Expected Scenario**|**Customer**|**System** |
|<p></p><p></p>|<p></p><p></p><p>**Step 1**: Customer invokes the Create Account Function</p><p></p><p>**Step 4**: The Customer enters the required data:</p><p></p><p>•   FirstName String (30)</p><p></p><p>•   LastName String (30)</p><p></p><p>•   DOB Date</p><p></p><p>•   PhoneNo String (15)</p><p></p><p>•   Email String (50)</p><p></p><p>•   Password String (20)</p><p></p><p></p><p></p><p></p><p></p><p></p><p></p><p></p><p></p><p></p>|<p></p><p></p><p>**Step 2**: Display UI.</p><p></p><p></p><p>**Step 5**: The system validates the data entered:</p><p></p><p>• All fields must be entered</p><p></p><p>• FirstName, LastName must not be numeric</p><p></p><p>• Phone number must contain only digits</p><p></p><p>• Email must comply with standard email format</p><p></p><p>• Password must be at least 8 characters</p><p></p><p>• DOB must indicate customer is 18+ years old</p><p></p><p>• Email and PhoneNo must be unique</p><p></p><p>**Step 6**: Generate unique AccountNo</p><p></p><p></p><p></p><p></p><p></p><p></p><p>**Step 8:** Save details in the Account File:</p><p>• AccountNo</p><p>• FirstName</p><p>• LastName</p><p>• DOB</p><p>• PhoneNo</p><p>• Email</p><p>• Password</p><p></p><p></p><p>**Step 9:** Display Confirmation Message</p><p></p><p></p><p></p><p>**Step 10**: Reset UI</p><p></p><p></p><p></p><p></p>|
|**Alternate Scenarios**|**Customer**|**System** |
|Invalid Data Entered||<p></p><p>**Step 5**: Validation test fails</p><p></p><p></p><p>**Step 6**: Display and appropriate error message</p><p></p><p></p><p>**Step 7**: return to Step 4</p><p></p><p></p><p></p>|
|**Conclusions**|The Account details have been saved in the system||
|**Post conditions**|Account can now be used for transactions.||
|**Business Rules**|||
|**Implementation Constraints**|||

1. ### <a name="_toc210129111"></a>Update Account
This function allows customers to update their account details in the system. Each account is uniquely identified by its account number.

|**Use Case Name**|Update Account||
| :- | :- | :- |
|**Use Case Id**|02||
|**Priority**|High||
|**Source**|Customer||
|**Primary Business Actor**|Customer||
|**Other Participating Actors**|||
|**Description**|This function updates details of customer account in the system.||
|**Preconditions**|The customer account must already exist in the system.||
|**Trigger**|||
|**Expected Scenario**|**Customer**|**System** |
||<p>**Step 1**: Starts Update Account function.</p><p></p><p></p><p></p><p>**Step 4:** Update the required data:</p><p></p><p>- FirstName</p><p>&emsp;&emsp;&emsp;</p><p>&emsp;&emsp;- LastName</p><p>&emsp;&emsp;&emsp;</p><p>&emsp;&emsp;- DOB</p><p>&emsp;&emsp;&emsp;</p><p>&emsp;&emsp;- PhoneNo String (15)</p><p>&emsp;&emsp;&emsp;</p><p>&emsp;&emsp;- Email String (50)</p><p>&emsp;&emsp;&emsp;</p><p>&emsp;&emsp;- Password String (20)</p><p></p><p></p><p></p><p></p>|<p>**Step 2:** Retrieve customer account details from the Account file</p><p></p><p>**Step 3**: Load on UI:</p><p></p><p></p><p></p><p>**Step 5:** Validate the data:</p><p></p><p>• All fields must be entered.</p><p></p><p>• Phone number must contain only digits</p><p></p><p>• Email and PhoneNo must be unique</p><p></p><p></p><p></p><p>**Step 6:** Update the required data:</p><p></p><p>**Step 7:** Display Confirmation Message and Reset UI</p><p></p><p></p>|
|**Alternate Scenarios**|**Customer**|**System** |
|Invalid Data Entered||<p></p><p>**Step 3:** Display Message: "No details found"</p><p></p><p>**Step 4:** Terminate Application Return to main menu</p><p></p><p>**Step 5:** Display an appropriate error message.</p><p></p>|
|**Conclusions**|The Account details have been updated in the system||
|**Post conditions**|Account updated and can now be used with new details.||
|**Business Rules**|||
|**Implementation Constraints**|||

1. ### <a name="_toc210129112"></a>Close Account
This function closes a customer account in the system. It updates the account's status to indicate that it is no longer available for transactions.

|<a name="_hlk209983712"></a>**Use Case Name**|Close Account||
| :- | :- | :- |
|**Use Case Id**|03||
|**Priority**|High||
|**Source**|Customer||
|**Primary Business Actor**|Customer||
|**Other Participating Actors**|||
|**Description**|This function closes a customer account in the system.||
|**Preconditions**|||
|**Trigger**|The customer no longer wants to use the account.||
|**Expected Scenario**|**Customer**|**System** |
|<p></p><p>**Customer closes account in the system**</p>|<p></p><p></p><p>**Step 1**: Starts Close Account functions</p><p></p><p></p><p>**Step 3:** Confirmation of closure action</p>|<p></p><p></p><p>**Step 2**: Retrieve account details from the Account file</p><p></p><p></p><p>**Step 5**:  Status is set to closed ('C') in Account file</p>|
|**Alternate Scenarios**|**Customer**|**System** |
|No account data found||<p></p><p>**Step 4**: Display error message</p><p></p><p>**Step 5:**  Return to main menu</p>|
|**Conclusions**|The Account details have been closed in the system||
|**Post conditions**|The account is marked as closed and is no longer available for transactions.||
|**Business Rules**|An account cannot be closed if it has pending transactions or transfers.||
|**Implementation Constraints**|||







1. ## <a name="_toc210129113"></a>**Management**
   1. ### <a name="_toc210129114"></a>Check Transaction History
View current account balance and recent transaction history for record-keeping.





|**Use Case Name**|Check Transaction History||
| :- | :- | :- |
|**Use Case Id**|04||
|**Priority**|High||
|**Source**|Customer||
|**Primary Business Actor**|Customer||
|**Other Participating Actors**|||
|**Description**|View current account balance and recent transaction history for record-keeping.||
|**Preconditions**|||
|**Trigger**|The customer no longer wants to see his funds ||
|**Expected Scenario**|**Customer**|**System** |
|<p></p><p>**Customer closes account in the system**</p>|<p></p><p></p><p>**Step 2**: The customer clicks on Transactrion History buttom  </p>|<p></p><p>**Step 1**: Retrieve account data from Account file to be displayed on UI:</p><p></p><p>- Current Balance</p><p></p><p>- Last Transaction History</p><p></p><p></p><p>**Step 3**: Display recent transaction history</p><p></p><p></p>|
|**Alternate Scenarios**|**Customer**|**System** |
|No account data found||<p></p><p>**Step 4**: Display error message</p><p></p><p>**Step 5:**  Return to main menu</p>|
|**Conclusions**|The use case concludes when the system successfully displays the account balance and information to the customer, presenting all relevant details of the account. At this point, the customer can choose to either check transaction history or return to the home or dashboard. The process ends based on the action selected by the customer.||
|**Post conditions**|||
|**Business Rules**|||

1. ### <a name="_toc210129115"></a>Enable 2FA
This use case describes the process by which a customer enables two-factor authentication (2FA) for their account. The function enhances account security by sending a 6-digit verification code to the customer's registered email address, which the customer must enter to complete the process.

|**Use Case Name**|Enable 2FA||
| :- | :- | :- |
|**Use Case Id**|05||
|**Priority**|High||
|**Source**|Customer||
|**Primary Business Actor**|Customer||
|**Other Participating Actors**|||
|**Description**|This function enables two-factor authentication by sending email verification with 6-digit code.||
|**Preconditions**|The customer account must exist and be active with valid email address.||
|**Trigger**|Customer wants to enhance account security.||
|**Expected Scenario**|**Customer**|**System** |
|<p></p><p>**Customer closes account in the system**</p>|<p></p><p></p><p>**Step 1:** Starts Enable 2FA function.</p><p></p><p>**Step 3:** The Customer enters required data:</p><p></p><p>• Email String (50)</p><p></p><p></p><p></p><p></p><p></p><p></p><p></p><p></p><p></p><p>**Step 6:** Enter the 6-digit code from email</p><p></p>|<p></p><p></p><p>**Step 2:** Display UI.</p><p></p><p></p><p>**Step 4**: Validate the data:</p><p></p><p>• AccountNo must exist in system</p><p></p><p>• Account must be active</p><p></p><p>• Email must match account email</p><p></p><p></p><p></p><p>**Step 5**: Generate 6-digit verification code and send</p><p></p><p></p><p>**Step 9:** Validate the entered code:</p><p>• Code must match sent Code</p><p>• Code must be exactly 6 digits</p><p></p><p></p><p></p><p>**Step 10**: Update Account file</p><p>:• Set TwoFAEnabled to 'Y</p><p></p><p>**'Step 11**: Display confirmation message and Reset UI </p><p></p><p></p><p></p><p></p><p></p><p></p><p></p>|
|**Alternate Scenarios**|**Customer**|**System** |
|<p></p><p>Invalid verification code</p><p></p><p></p><p></p>||<p></p><p>**Step 9:** Code validation fails</p><p></p><p>**Step 10:** Display message "Invalid verification code"</p><p></p><p>**Step 11:** Return to Step 8</p>|
|<p></p><p>Email not received</p>||<p></p><p>**Step 7:** Email sending fails</p><p></p><p>**Step 8:** Display message "Email could not be sent"</p><p></p><p>**Step 9:** Return to Step 3</p>|
||||
|**Conclusions**|Two-factor authentication has been enabled successfully after email verification||
|**Post conditions**|Account security is enhanced with 2FA protection. User will need 2FA for future logins.||
|**Business Rules**|2FA can only be enabled with valid email verification. Once enabled, 2FA will be required for login access.||
|**Implementation Constraints**|||

1. ## <a name="_toc210129116"></a>**Money Transfer**
This module enables users to manage and execute financial transactions efficiently. Users can add 

funds to their account, send money to external accounts, and view confirmation details of completed transfers to ensure accuracy and transparency.
1. ### <a name="_toc210129117"></a>Add Funds
Load money into your account from linked sources.

|**Use Case Name**|Add Funds||
| :- | :- | :- |
|**Use Case Id**|06||
|**Priority**|1||
|**Source**|Customer||
|**Primary Business Actor**|Customer||
|**Other Participating Actors**|||
|**Description**|This function add money to account||
|**Preconditions**|||
|**Trigger**|||
|**Expected Scenario**|**Customer**|**System** |
||<p>**Step 1**:  Customer invokes the Add Funds Function</p><p></p><p>**Step 3**: The Customer enters the required data:</p><p></p><p>- Card Holder Name</p><p>- Card Number</p><p>- Expire Date</p><p>- CVV</p><p>- Top-Up Amount</p>|<p>**Step 2**:  The system displays the UI for account creation</p><p></p><p>**Step 4**: The system validates the data entered:</p><p>Card Holder Name:</p><p>- Must contain only letters and spaces (no numbers or special characters)</p><p>- Length: 2 to 50 characters</p><p>Card Number:</p><p>- Must be 13 to 19 digits.</p><p>- Digits only (no spaces or dashes)</p><p>Expire Date:</p><p>- Format: MM/YY or MM/YYYY</p><p>- Must be a valid future date</p><p>- Month must be between 01 and 12</p><p>- Should not be in the past</p><p>CVV: </p><p>- Must be 3 digits </p><p>- Digits only.</p><p>Value:</p><p>- Must be a positive number</p><p>- Can include up to 2 decimal places</p><p></p><p>- Minimum amount: e.g., $1.00 (adjust as needed for your business rules)</p><p>- Maximum amount: e.g., $10,000.00 (optional cap to prevent abuse or fraud)</p><p>- No letters, special characters, or commas.</p><p>- Must not be zero or negative</p><p>**Step 5**: The system adds to current balance the top-up amount</p><p></p><p>**Step 6**: The system saves the balance:</p><p>- Balance</p><p></p><p>**Step 7**: The system displays a confirmation message</p><p></p><p>**Step 8**: The system resets the UI</p><p></p><p></p>|
|**Alternate Scenarios**|**Customer**|**System**|
|Invalid Data Entered||<p>**Step 4:** Validation test fails</p><p></p><p>**Step 5:** Display and appropriate error message</p><p></p><p>**Step 6:** return to Step 3</p><p></p>|
|**Conclusions**|The top-up process is completed successfully after all inputs are validated.||
|**Post conditions**|The account balance is updated with the top-up amount and saved in the accounts file.||
|**Business Rules**|||
|**Implementation Constraints**|||

1. ### <a name="_toc210129118"></a>Send Money 
Transfer funds securely to external bank accounts or recipients

|**Use Case Name**|Send Money||
| :- | :- | :- |
|**Use Case Id**|07||
|**Priority**|1||
|**Source**|Customer||
|**Primary Business Actor**|Customer||
|**Other Participating Actors**|||
|**Description**|Transfer funds securely to external bank accounts or recipients||
|**Preconditions**|||
|**Trigger**|||
|**Expected Scenario**|**Customer**|**System** |
||<p>**Step 1**:  Customer invokes the Send Money Function</p><p></p><p>**Step 3**: The Customer enters the required data:</p><p>- Card Holder Name</p><p>- Card Number</p><p>- Message</p><p>- Total Amount</p><p></p>|<p>**Step 2**:  The system displays the UI for account creation</p><p></p><p>**Step 4**:  The system validates the data entered:</p><p>Card Holder Name:</p><p>- Alphabetic characters only (allow spaces and hyphens)</p><p>- Length 2 to 50 characters</p><p>Card Number:</p><p>- 13 to 19 digits (numeric only)</p><p>Message:</p><p>- Any characters, sanitized to prevent XSS or injection</p><p>- Length max 200 characters </p><p>Total Amount:</p><p>- Greater than 0</p><p>- 2 decimal places</p><p></p><p>**Step 5**: The system updates Balance in Accounts File</p><p></p><p>**Step 6**: The system decreases Total Amount from Balance and saves the updated balance:</p><p>- Balance</p><p></p><p>**Step 7**: The system displays a confirmation message</p><p></p><p>**Step 8**: The system resets the UI</p><p></p><p>**Step 9**: Displays Home menu</p>|
|**Alternate Scenarios**|**Customer**|**System** |
|Invalid Data Entered||<p></p><p>**Step 4:** Validation test fails</p><p></p><p>**Step 5:** Display and appropriate error message</p><p></p><p>**Step 6:** return to Step 3</p><p></p>|
|**Conclusions**|The money transfer is either successfully completed with confirmation and balance updated, or it fails with clear validation errors prompting the customer to try again. The system returns to the home menu in both cases.||
|**Post conditions**|If successful, the amount is deducted, the transaction is saved, and the customer sees a confirmation. If unsuccessful, no changes occur, and the user is prompted to correct the input.||
|**Business Rules**|||
|**Implementation Constraints**|||

1. ### <a name="_toc210129119"></a>Display Confirmation
View detailed summaries of successful transactions for record-keeping.

|**Use Case Name**|Display Confirmation||
| :- | :- | :- |
|**Use Case Id**|08||
|**Priority**|1||
|**Source**|Customer||
|**Primary Business Actor**|Customer||
|**Other Participating Actors**|||
|**Description**|View detailed summaries of successful transactions for record-keeping.||
|**Preconditions**|||
|**Trigger**|||
|**Expected Scenario**|**Customer**|**System** |
||<p></p><p></p><p></p><p></p><p></p><p></p><p></p><p></p><p></p><p></p><p></p><p></p><p></p><p></p><p></p><p>**Step 2**: The customer option in this UI</p><p>- Send Money Again</p><p>- Return to Home / Dashboard</p><p></p>|<p>**Step 1**:  Retrieve data from Send Money function to be displayed on UI:</p><p>- Transaction Status: Successful or Failed</p><p>- Date & Time</p><p>- Recipient/Card Holder Name</p><p>- Card Number (Masked)</p><p>- Amount Sent</p><p>- Message (if provided)</p><p>- Remaining Balance</p><p></p><p></p><p></p>|
|**Alternate Scenarios**|**Customer**|**System** |
|<p>Send Money Again</p><p></p><p>Return to Home / Dashboard</p>|<p>**Step 2**: Click on this option</p><p></p><p>**Step 2**: Click on this option </p>|<p>**Step 3**: return to Send Money function</p><p>**Step 3**:  Return to Home / Dashboard</p><p></p>|
|**Conclusions**|The use case concludes when the system successfully displays the transaction confirmation screen to the customer, presenting all relevant details of the transaction. At this point, the customer can choose to either send money again or return to the home or dashboard. The process ends based on the action selected by the customer.||
|**Post conditions**|After the use case is completed, the transaction details have been displayed for the customer's review. The transaction is recorded in the system for reference or future use. The customer is presented with options to proceed, but no further system activity occurs unless the customer initiates a new action.||
|**Business Rules**|||
|**Implementation Constraints**|||

#
1. # <a name="_toc526502576"></a><a name="_toc210129120"></a>**System Model**
The following dataflow diagrams have been produced for the system:

1. ## <a name="_toc526502577"></a><a name="_toc210129121"></a>**Level-0 DFD**

1. ## <a name="_toc526502578"></a><a name="_toc210129122"></a>**Level-1 DFD**
![A diagram of a customer

AI-generated content may be incorrect.](Aspose.Words.5df10e91-2a4a-482a-b320-541595eab007.003.png)
1. ## <a name="_toc526502579"></a><a name="_toc210129123"></a>**Level-2 DFD** (Process P1: Title)

1. ## <a name="_toc526502580"></a><a name="_toc210129124"></a>**Level-2 DFD** (Process P2: Title)

1. ## <a name="_toc526502581"></a><a name="_toc210129125"></a>**Level-2 DFD** (Process P3: Title)


1. # <a name="_toc526502582"></a><a name="_toc210129126"></a>**Data Model (UML Class Diagram)**
   Brief introduction……


   1. ## <a name="_toc526502583"></a><a name="_toc210129127"></a>**Class Diagram** 
      Include class diagram / Object Model – UML Class Diagram here

      Class diagram shows objects & attributes (NO METHODS)

      ![A screenshot of a diagram

AI-generated content may be incorrect.](Aspose.Words.5df10e91-2a4a-482a-b320-541595eab007.004.png)



   1. ## <a name="_toc526502584"></a><a name="_toc210129128"></a>**Relational Schema** 
      Relational schema for the data requirements - Using ***bracket notation***

**Accounts** (AccountID, FirstName, LastName, DOB, PhoneNo, Email, Password, TwoFAEnabled, Status, Balance, CreatedAt)

**Transactions** (TransactionID, AccountID\*, Type, Amount, DateTime, Description, BalanceAfter)

**Transfers** (TransferID, FromAccountID\*, ToAccountID\*, ExternalBank, ExternalAccountNo, Amount, TransferDate, Status, ConfirmCode)

1. ## <a name="_toc526502585"></a><a name="_toc210129129"></a>**Database Schema** 
   A definition of the database to be implemented.

   This includes primary key, foreign key and other constraints to be implemented.

   Schema: PHP Bank

   Relation: Accounts

   Attributes:

   `    `AccountID NUMBER(5) NOT NULL,

   `    `FirstName VARCHAR2(30) NOT NULL,

   `    `LastName VARCHAR2(30) NOT NULL,

   `    `DOB DATE,

   `    `PhoneNo VARCHAR2(15) NOT NULL UNIQUE,

   `    `Email VARCHAR2(50) NOT NULL UNIQUE,

   `    `Password VARCHAR2(20) NOT NULL,

   `    `TwoFAEnabled CHAR(1) DEFAULT 'N' CHECK (TwoFAEnabled IN ('Y', 'N')),

   `    `Status CHAR(1) DEFAULT 'A' NOT NULL CHECK (Status IN ('A','C')),

   `    `Balance NUMBER(12,2) DEFAULT 0 NOT NULL,

   `    `CreatedAt DATE DEFAULT SYSDATE

   Primary Key:

   `    `AccountID

   Relation: Transactions

   Attributes:

   `    `TransactionID NUMBER(8) NOT NULL,

   `    `AccountID NUMBER(5) NOT NULL,

   `    `Type VARCHAR2(20) NOT NULL, 

   `    `Amount            NUMBER(12,2) NOT NULL,

   `    `DateTime         DATE DEFAULT SYSDATE,

   `    `Description      VARCHAR2(100),

   `    `BalanceAfter    NUMBER(12,2) NOT NULL

   Primary Key:

   `    `TransactionID

   Foreign Key:

   `    `(AccountID) REFERENCES Accounts(AccountID)

   Relation: Transfers

   Attributes:

   `    `TransferID               NUMBER(8) NOT NULL,

   `    `FromAccountID     NUMBER(5) NOT NULL,

   `    `ToAccountID           NUMBER(5),

   `    `ExternalBank          VARCHAR2(50),

   `    `ExternalAccountNo VARCHAR2(30),

   `    `Amount            NUMBER(12,2) NOT NULL,

   `    `TransferDate      DATE DEFAULT SYSDATE,

   `    `Status            VARCHAR2(10) DEFAULT 'Pending',

   `    `ConfirmCode       VARCHAR2(10) 

   Primary Key:

   `    `TransferID

   Foreign Key:

   `    `(FromAccountID) REFERENCES Accounts(AccountID)

   `    `(ToAccountID) REFERENCES Accounts(AccountID)


1. # <a name="_toc526502586"></a><a name="_toc210129130"></a>**Conclusion**




