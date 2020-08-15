<!doctype html>
<!--[if IE 6 ]><html lang="en-us" class="ie6"> <![endif]-->
<!--[if IE 7 ]><html lang="en-us" class="ie7"> <![endif]-->
<!--[if IE 8 ]><html lang="en-us" class="ie8"> <![endif]-->
<!--[if (gt IE 7)|!(IE)]><!-->
<html lang="en-us">
<!--<![endif]-->

<head>
    <meta charset="utf-8">
    <title>SaleProPOS</title>
    <meta name="description" content="">
    <meta name="author" content="DZ-DEV">
    <meta name="copyright" content="DZ-DEV">
    <meta name="generator" content="Documenter v2.0 http://rxa.li/documenter">
    <meta name="date" content="2017-04-26T00:00:00+02:00">
    <!-- Google fonts - Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:400,700">
    <link rel="stylesheet" href="<?php echo e(url('readme/assets/css/documenter_style.css')); ?>" media="all">
    <link rel="stylesheet" href="assets/css/jquery.mCustomScrollbar.css" media="all">

    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/jquery.scrollTo.js"></script>
    <script src="assets/js/jquery.easing.js"></script>
    <script src="assets/js/jquery.mCustomScrollbar.js"></script>
    <script>
        document.createElement('section');
        var duration = '500',
            easing = 'swing';
    </script>
    <script src="assets/js/script.js"></script>
</head>

<body>
    <div id="documenter_sidebar">
        <img src="assets/images/logo.png" style="border: none;margin: 20px 20px 0;width: 180px">
        <ul id="documenter_nav">
            <li><a class="current" href="#documenter_cover">Start</a></li>
            <li><a href="#server_requirement" title="SERVER REQUIREMENTS">Server Requirements</a></li>
            <li><a href="#install" title="INSTALL">Install</a></li>
            <li><a href="#update" title="SOFTWARE UPDATE">Software Update</a></li>
            <li><a href="#pos-printer" title="POS Printer Configuration">POS Printer Settings</a></li>
            <li><a href="#mail" title="SETUP MAIL SERVER">Setup Mail Server</a></li>
            <li><a href="#dashboard" title="DASHBOARD">Dashboard</a></li>
            <li><a href="#product" title="PRODUCT">Product</a></li>
            <li><a href="#adding-stock" title="Adding Stock">Adding Stock</a></li>
            <li><a href="#purchase" title="PURCHASE">Purchase</a></li>
            <li><a href="#sale" title="SALE">Sale</a></li>
            <li><a href="#expense" title="EXPENSE">Expense</a></li>
            <li><a href="#quotation" title="QUOTATION">Quotation</a></li>
            <li><a href="#adjustment" title="QUANTITY ADJUSTMENT">Quantity Adjustment</a></li>
            <li><a href="#stock-count" title="STOCK COUNT">Stock Count</a></li>
            <li><a href="#transfer" title="TRANSFER">Transfer</a></li>
            <li><a href="#return" title="RETURN">Return</a></li>
            <li><a href="#accounting" title="ACCOUNTING">Accounting</a></li>
            <li><a href="#hrm" title="HRM">HRM</a></li>
            <li><a href="#people" title="PEOPLE">People</a></li>
            <li><a href="#reports" title="REPORTS">Reports</a></li>
            <li><a href="#setting" title="SETTINGS">Settings</a></li>
            <li><a href="#translation" title="TRANSLATION">Translation</a></li>
            <li><a href="#video_tutorial" title="VIDEO TUTORIAL">Video Tutorial</a></li>
            <li><a href="#support" title="SUPPORT">Support</a></li>
        </ul>
    </div>
    <div id="documenter_content">
        <section id="documenter_cover">
            <h1>SalePro - Inventory Management System with POS, HRM, Accounting</h1>
            <div id="documenter_buttons">
            </div>
            <hr>
            <ul>
                <li>by: DZ-DEV</li>
                <li>email: <a href="mailto:hello@lion-coders.com">hello@lion-coders.com</a></li>
            </ul>
            <p>SaleProPOS is a software that will help you to manage your inventory, accounting and hrm. We believe that
                this software is suitable for both wholesale and retail buisness model and an ideal product for any
                Super Shop. This user friendly software is fully responsive and has many features. Hope that this
                software will be helpful to manage your buisness inventory.</p>
        </section>
        <section id="server_requirement">
            <div class="page-header">
                <h3>SERVER REQUIREMENT</h3>
                <hr class="notop">
            </div>
            <p>
                All our products are designed on most popular PHP framework Laravel. You need to have minimum
                requirement for running all our application. Please make sure that you have completed these
                requirements.</p>
            <ul>
                <li>
                    Preferred Server - Apache/Nginx</li>
                <li><strong>PHP Version &gt;= 7.1</strong></li>
                <li>OpenSSL PHP Extension&nbsp;</li>
                <li>PDO PHP Extension&nbsp;</li>
                <li>PHP Fileinfo Extension</li>
                <li>Mbstring PHP Extension&nbsp;</li>
                <li>Tokenizer PHP Extension&nbsp;</li>
                <li>Zip Archive PHP Extension&nbsp;</li>
                <li>Mod Rewrite Enabled</li>
            </ul>
            <p>
                &nbsp;</p>
            <p>
                <strong>Please note if you try to install the application on any other server say LiteSpeed or IIS, you
                    may get undesirable result. We do not recommend you to use other server than Apache or Nginx. Also
                    we do not provide support for installation in server other than Apache.</strong></p>
        </section>
        <section id="install">
            <div class="page-header">
                <h3>INSTALL</h3>
                <hr class="notop">
            </div>
            <p>
                First Upload the <strong>salepropos.zip</strong> file to server. Then extract the zip file. Make sure
                that your server is showing hidden(.dot files) files.
            </p>
            <h2><strong>IMPORT Database</strong></h2>
            <ul>
                <li>
                    After unziping the downloaded folder you will find a folder named <strong>dbBackup</strong>. Inside
                    it you will find <strong>salepropos.sql</strong>.
                </li>
                <li>
                    Create a database on your phpmyadmin and import <strong>salepropos.sql</strong> into the database.
                </li>
            </ul>
            <h2><strong>Connect Database</strong></h2>
            <ul>
                <li>
                    Open <strong>Salepropos</strong> folder. Find <strong>.env</strong> hidden file. Open with text
                    editor.
                </li>
                <li>
                    Change DB_DATABASE, DB_USERNAME, DB_PASSWORD with your database name, username and password.
                </li>
            </ul>
            <img alt="" src="assets/images/update_env.png">
            <p>After that login with username:<strong>admin</strong> password:<strong>admin</strong></p>
            <br>
            <h2>Installation Video</h2>
            <p>Watch is a video demonstrating the steps stated above. (you'll need internet connection to play the
                video)</p>
            <iframe width="560" height="315" src="https://www.youtube.com/embed/w2ZwRPQzzvk" frameborder="0"
                allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                allowfullscreen></iframe>
            <br><br>
            <p>You can also watch this video on <a href="https://www.youtube.com/watch?v=w2ZwRPQzzvk">youtube</a></p>
        </section>
        <section id="update">
            <div class="page-header">
                <h3>SOFTWARE UPDATE</h3>
                <hr class="notop">
            </div>
            <h2><strong>UPDATE with Existing Data</strong></h2>
            <p>You can update the software very easily by following 4 steps:</p>
            <ul>
                <li>Rename your previous database like salepropos-backup.sql.</li>
                <li>Delete the project folder and reinstall it</li>
                <li>Merge your present database with previous one with <a
                        href="https://www.red-gate.com/products/mysql/mysql-compare/index">MySQL Compare</a>. If you are
                    a linux user you can use <a href="https://www.navicat.com/en/">Navicat</a> to merge database.</li>
                <li>After that delete the new database and rename the previous one with present database name like
                    salepropos-backup.sql to salepropos.sql.</li>
            </ul>
            <p><strong>Please follow the following spanshots carefully to merge database:</strong></p>
            <p>Open the software.</p>
            <p>
                <img alt="" src="assets/images/update1.png">
            </p>
            <p>Select your source and target database and click compare now.</p>
            <p>
                <img alt="" src="assets/images/update2.png">
            </p>
            <p>After comparing successfully two database click ok.</p>
            <p>
                <img alt="" src="assets/images/update3.png">
            </p>
            <p>Then select the checkbox and click Diployment Wizard.</p>
            <p>
                <img alt="" src="assets/images/update4.png">
            </p>
            <p>Uncheck the Recompare after deployment checkbox and click next.</p>
            <p>
                <img alt="" src="assets/images/update5.png">
            </p>
            <p>Click Deploy now.</p>
            <p>
                <img alt="" src="assets/images/update6.png">
            </p>
            <p>Click Ok.</p>
            <p>
                <img alt="" src="assets/images/update7.png">
            </p>
            <p>Thats all! You have just updated the database. Now follow step 4 as we described earlier.</p>
            <h2><strong>UPDATE without Existing Data</strong></h2>
            <p>You can update the software very easily by following 2 steps:</p>
            <ul>
                <li>Delete your previous database it.</li>
                <li>Delete the project folder and reinstall it</li>
            </ul>
            <p><strong>Still facing problem? Don't worry! We can update your software for USD 10. Please contact us at
                    <a href="mailto:support@lion-coders.com">support@lion-coders.com</a>.</strong></p>
        </section>
        <section id="pos-printer">
            <div class="page-header">
                <h3>POS Printer Configuration</h3>
                <hr class="notop">
            </div>
            <p>
                First you have to install your printer driver. Then go to settings and select Devices.
            </p>
            <p>
                <img alt="" src="assets/images/pos_printer1.png">
            </p>
            <p>
                Then go to Devices and printers.
            </p>
            <p>
                <img alt="" src="assets/images/pos_printer2.png">
            </p>
            <p>
                Set your POS printer as default printer.
            </p>
            <p>
                <img alt="" src="assets/images/pos_printer3.png">
            </p>
            <p>
                Then go to Printing preferences.
            </p>
            <p>
                <img alt="" src="assets/images/pos_printer4.png">
            </p>
            <p>
                Then go to Advanced.
            </p>
            <p>
                <img alt="" src="assets/images/pos_printer5.png">
            </p>
            <p>
                Select 3rd option of paper size and click Ok.
            </p>
            <p>
                <img alt="" src="assets/images/pos_printer6.png">
            </p>
            <p>
                After that go to printer properties.
            </p>
            <p>
                <img alt="" src="assets/images/pos_printer7.png">
            </p>
            <p>
                Go to device settings and select 3rd option of auto.
            </p>
            <p>
                <img alt="" src="assets/images/pos_printer8.png">
            </p>
            <p>
                Please make sure you choose correct paper size(3rd option) when you want to print the invoice.
            </p>
            <p>
                <img alt="" src="assets/images/pos_printer9.png">
            </p>
        </section>
        <section id="mail">
            <div class="page-header">
                <h3>SETUP MAIL SERVER</h3>
                <hr class="notop">
            </div>
            <p>
                To add mail functionality to your inventory you have to setup mail server first. To do this go to
                <strong>Mail Setting</strong> under <strong>Setting</strong> module. You have to fill up the following
                information.
            </p>
            <p>
                <img alt="" src="assets/images/mail1.png">
            </p>
        </section>
        <section id="dashboard">
            <div class="page-header">
                <h3>DASHBOARD</h3>
                <hr class="notop">
            </div>
            <p>
                We have a gorgeous looking dashboard for our customer from where they get Revenue, Sale Return, Purchase
                Return and Profit information of today / last 7 days / current month / current year at a glance by one
                click.
            </p>
            <p>
                <img alt="" src="assets/images/dashboard1.png">
            </p>
            <p>You will get information of your cash flow that means how much money you are earning and how much money
                you are spending from this line chart.</p>
            <p>
                <img alt="" src="assets/images/dashboard4.png">
            </p>
            <p>You also aware of your current month's <strong>purchase</strong>, <strong>revenue</strong>
                <strong>expenditure</strong> froms this doughnut chart.</p>
            <p>
                <img alt="" src="assets/images/dashboard5.png">
            </p>
            <p>A bar chart shows Yearly report of purchases and sales of current year.</p>
            <p><img alt="" src="assets/images/dashboard2.png"></p>
            <p>From <strong>Dashboard</strong> You will also get recent transaction(sale, purchase, quotation, payment)
                and top 5 best selling product of current month and current year.
            </p>
            <p><img alt="" src="assets/images/dashboard3.png"></p>
        </section>
        <section id="product">
            <div class="page-header">
                <h3>PRODUCT</h3>
                <hr class="notop">
            </div>
            <h2><strong>Category</strong></h2>
            <p>You can add, edit and delete product category. You can also import category from CSV file and export
                table data to PDF and CSV. Also you can print data from table.</p>
            <p>
                <img alt="" src="assets/images/category1.png">&nbsp;&nbsp;
                <img alt="" src="assets/images/category2.png">
            </p>
            <p>
                <img alt="" src="assets/images/category3.png">&nbsp;&nbsp;
                <img alt="" src="assets/images/category4.png">
            </p>
            <p>
                If you dont want to export any column you can do this by clicking Column Visibility button. From here
                you can choose column to remove from table.
            </p>
            <p>
                <img alt="" src="assets/images/category5.png">&nbsp;&nbsp;
                <img alt="" src="assets/images/category6.png">
            </p>
            <p>To export data from specific row you just have to check the checkbox of the related row</p>
            <p>
                <img alt="" src="assets/images/category9.png">
            </p>
            <p>If you want to delete all the row from table you can do this very easily as shown below. You can also
                delete specific row from table.</p>
            <p>
                <img alt="" src="assets/images/category10.png">
            </p>
            <p>
                If you want to search anything from the table you can simply type the word in the search box.
            </p>
            <p>
                <img alt="" src="assets/images/category7.png">
            </p>
            <p>
                You can also control the pagination from <strong>Show</strong> dropdown.
            </p>
            <p>
                <img alt="" src="assets/images/category8.png">
            </p>
            <h2><strong>Product</strong></h2>
            <p>In product section you will just add general information of a product. <strong>To add stock you have to
                    purchase that product.</strong> You can create three types of product in SaleProPOS.</p>
            <ul>
                <li>Standard</li>
                <li>Digital</li>
                <li>Combo (Combination of standard product. Like mango juice is a combo product as it is consist of
                    mango and sugar ).</li>
            </ul>
            <p>You can add, edit and delete product. You can import product from CSV. <strong>You must follow the
                    instruction to import data from CSV</strong>. To get better understanding you can download the
                sample file.</p>
            <p>
                <img alt="" src="assets/images/product1.png">&nbsp;&nbsp;
                <img alt="" src="assets/images/product2.png">
            </p>
            <p>You can sort table data according to column</p>
            <p><img alt="" src="assets/images/product3.png"></p>
            <p>And you can search, export and print data from table that we discussed earlier in greater detail.</p>
        </section>
        <section id="adding-stock">
            <div class="page-header">
                <h3>ADDING STOCK</h3>
                <hr class="notop">
            </div>
            <P>In <strong>Product</strong> section you just added general information of product. So where the stock
                comes from? To add stock you have to purchase that product for specific warehouse. This software is
                pretty smart that it will automatically update the stock quantity and you don't have to worry about it.
            </P>
        </section>
        <section id="purchase">
            <div class="page-header">
                <h3>PURCHASE</h3>
                <hr class="notop">
            </div>
            <h2><strong>Add Purchase</strong></h2>
            <p>You can create purchase in Purchase module. <strong>By creating purchase the stock quantity of product
                    will be increased.</strong> .There are three purchase status: Recieved, Partial, Pending, Orderd.
                You can add product to order table by typing or scanning barcode of product</p>
            <p>
                <img alt="" src="assets/images/purchase1.png">&nbsp;&nbsp;
                <img alt="" src="assets/images/purchase2.png">
            </p>
            <p>You can also edit product info from order table.</p>
            <p><img alt="" src="assets/images/purchase3.png"></p>
            <p>After creating purchase you will be redirected to purchase index page. You will get summary of purchase
                from table. To get details you just have to click in the table row.</p>
            <p><img alt="" src="assets/images/purchase4.png"></p>
            <h2><strong>Import Purchase</strong></h2>
            <p>You can import sale from CSV.<strong>You must follow the instruction to import data from CSV</strong>. To
                get better understanding you can download the sample file. </p>
            <p><img alt="" src="assets/images/purchase7.png"></p>
            <h2><strong>Payment</strong></h2>
            <p>You can make payment from Purchase table. You can make payment with Cash, Gift Card, Cheque, Credit card
                and Deposit.</p>
            <p><img alt="" src="assets/images/purchase5.png">&nbsp;&nbsp;
                <img alt="" src="assets/images/purchase6.png">
            </p>
            <p>And you can search, export and print data from table that we discussed in <a href="#product">Product</a>
                section.</p>
        </section>
        <section id="sale">
            <div class="page-header">
                <h3>SALE</h3>
                <hr class="notop">
            </div>
            <h2><strong>POS</strong></h2>
            <p>You can create sale from POS. Customer, Warehouse and Biller (representative of your company) will be
                automatically selected according to POS Settings under <a href="#setting">Settings</a> module. Touch
                screen keybord is activated in POS module. You can add product to order table by typing or scanning
                barcode of product. Featured Product will be displayed in the right side. You can also add product by
                clicking product image. You can edit product info from order table.</p>
            <p>
                <img alt="" src="assets/images/sale1.png">
                <img alt="" src="assets/images/sale2.png">&nbsp;&nbsp;
                <img alt="" src="assets/images/sale3.png">
            </p>
            <p>To add order discount, order tax and shipping cost you just have to click the button that are shown
                below. To finalize the sale you have to click the <strong>Payment</strong> button.</p>
            <p><img alt="" src="assets/images/sale4.png"></p>
            <p>After creating sale you will be redirected to sale index page. A confirmation mail will be sent
                automatically to customer's email with sale details. You will get summary of sale from table. To get
                details you just have to click in the table row.</p>
            <p>You can also generate <strong>Invoice</strong> automatically which is beutifully designed</p>
            <p><img alt="" src="assets/images/sale6.png"></p>
            <p>You can also create sale by clicking Add Sale button. Also you can import sale from CSV.<strong>You must
                    follow the instruction to import data from CSV</strong>. To get better understanding you can
                download the sample file. </p>
            <p><img alt="" src="assets/images/sale5.png"></p>
            <h2><strong>Payment</strong></h2>
            <p>You can make payment from Sale table. You can make payment with Cash, Cheque, Credit Card, Gift Card,
                Deposit and Paypal. A confirmation mail will be sent automatically to customer's email with payment
                details.</p>
            <p><img alt="" src="assets/images/purchase5.png">&nbsp;&nbsp;
                <img alt="" src="assets/images/purchase6.png">
            </p>
            <p>And you can search, export and print data from table that we discussed in <a href="#product">Product</a>
                section.</p>
            <h2><strong>Delivery</strong></h2>
            <p>You can add delivery for your sold products. A confirmation mail will be sent automatically to customer's
                email with delivery details.</p>
            <p><img alt="" src="assets/images/delivery1.png"></p>
            <p>And you can search, export and print data from table that we discussed in <a href="#product">Product</a>
                section.</p>
            <h2><strong>Gift Card</strong></h2>
            <p>You can sell GiftCard to customer. By using gift card customer can purchase product. Again GiftCard can
                be recharged. Customer will be notified by mail when assigning or recharging a GiftCard.</p>
            <p>
                <img alt="" src="assets/images/gift_card1.png">&nbsp;&nbsp;
                <img alt="" src="assets/images/gift_card2.png">
            </p>
        </section>
        <section id="expense">
            <div class="page-header">
                <h3>EXPENSE</h3>
                <hr class="notop">
            </div>
            <h2><strong>Expense Category</strong></h2>
            <p>You can create, edit and delete expense category in Expense module.</p>
            <p>
                <img alt="" src="assets/images/expense1.png">
            </p>
            <h2><strong>Expense</strong></h2>
            <p>You can create, edit and delete expense in Expense module.</p>
            <p>
                <img alt="" src="assets/images/expense2.png">
            </p>
            <p>And you can search, export and print data from table that we discussed in <a href="#product">Product</a>
                section.</p>
        </section>
        <section id="quotation">
            <div class="page-header">
                <h3>QUOTATION</h3>
                <hr class="notop">
            </div>
            <h2><strong>Add Quotation</strong></h2>
            <p>You can create quotation in Quotation module. There are two quotation status: Pending and Sent</p>
            <p>
                <img alt="" src="assets/images/quotation1.png">
            </p>
            <p>If quotation status is <strong>Sent</strong> a confirmation mail will be sent automatically to customer's
                email with quotation details.</p>
            <h2><strong>Create Sale</strong></h2>
            <p>You can create sale from Quotation.</p>
            <p><img alt="" src="assets/images/quotation2.png">
            </p>
            <h2><strong>Create Purchase</strong></h2>
            <p>You can create purchase from Quotation.</p>
            <p><img alt="" src="assets/images/quotation3.png">
            </p>
            <p>And you can search, export and print data from table that we discussed in <a href="#product">Product</a>
                section.</p>
        </section>
        <section id="adjustment">
            <div class="page-header">
                <h3>QUANTITY ADJUSTMENT</h3>
                <hr class="notop">
            </div>
            <h2><strong>Add Adjustment</strong></h2>
            <p>You can adjust product quantity in Quantity Adjustment module. There will be two operation: Subtraction
                and Addition</p>
            <p>
                <img alt="" src="assets/images/adjustment1.png">
                <img alt="" src="assets/images/adjustment2.png">
            </p>
            <p>And you can search, export and print data from table that we discussed in <a href="#product">Product</a>
                section.</p>
        </section>
        <section id="stock-count">
            <div class="page-header">
                <h3>STOCK COUNT</h3>
                <hr class="notop">
            </div>
            <p>You can count your stock from this module. Two types are available: <strong>Full</strong> and
                <strong>Partial</strong>. In Partial type user have to specify brand and category and the software will
                automatically count the stock for that brand or category. Then this information will be written in CSV
                file which you have to download to finalize the stock count. Please follow the instruction properly.
                After finalizing the stock count you can automatically adjust the quantity of products if it is
                necessary.</p>
        </section>
        <section id="transfer">
            <div class="page-header">
                <h3>TRANSFER</h3>
                <hr class="notop">
            </div>
            <h2><strong>Add Transfer</strong></h2>
            <p>You can transfer your product from one warehouse to another in Transfer module. You can also transfer
                product with CSV file. <strong>You must follow the instruction to import data from CSV.</strong> To get
                better understanding you can download the sample file. You will get details of transfer by clicking in
                the table row.</p>
            <p>
                <img alt="" src="assets/images/transfer1.png">
            </p>
            <p>And you can search, export and print data from table that we discussed in <a href="#product">Product</a>
                section.</p>
        </section>
        <section id="return">
            <div class="page-header">
                <h3>RETURN</h3>
                <hr class="notop">
            </div>
            <h2><strong>Add Return</strong></h2>
            <p>You can return your product with Return module. You can track return of both purchase and sale with this
                module. A confirmation mail will be sent automatically to customer's email with return details if
                customer refund products. Again if you return product to supplier a confirmation mail will be sent
                automatically to supplier's email with return details. You will get details of return by clicking in the
                table row.</p>
            <p>
                <img alt="" src="assets/images/return1.png">
            </p>
            <p>And you can search, export and print data from table that we discussed in <a href="#product">Product</a>
                section.</p>
        </section>
        <section id="accounting">
            <div class="page-header">
                <h3>Accounting</h3>
                <hr class="notop">
            </div>
            <h2><strong>Account</strong></h2>
            <p>You can create,edit and delete account to link all your transactions. You can also set default account
                for sale. All the payments must be done under an account.</p>
            <p>
                <img alt="" src="assets/images/accounting_1.png">
            </p>
            <p>You can generate <strong>Balance Sheet</strong> of your accounts. You can also make <strong>Account
                    Statement</strong> of an specific account to see all the transactions which has done with this
                account.</p>
        </section>
        <section id="hrm">
            <div class="page-header">
                <h3>HRM</h3>
                <hr class="notop">
            </div>
            <h2><strong>Department</strong></h2>
            <p>You can create,edit and delete department of your company.</p>
            <h2><strong>Employee</strong></h2>
            <p>You can create,edit and delete employee of your company. You can also give user access to employee.</p>
            <h2><strong>Attendance</strong></h2>
            <p>You can take employee attendance with this software. You can set CheckIn and CheckOut time in HRM Setting
                option under Setting Module.</p>
            <h2><strong>Payroll</strong></h2>
            <p>You can make payroll of your employee with this software. All payroll must be done from an specipic
                account.</p>
        </section>
        <section id="people">
            <div class="page-header">
                <h3>PEOPLE</h3>
                <hr class="notop">
            </div>
            <h2><strong>Add User</strong></h2>
            <p>You can create, edit and delete user account. By creating user account password will be sent to the
                user's email that is given. Again you can active or inactive a user.</p>
            <p>There is also be a register option to create user account. But his/her ID will not be activated untill
                admin will approve it.</p>
            <p>
                <img alt="" src="assets/images/user1.png">
            </p>
            <h2><strong>Add Customer</strong></h2>
            <p>You can create, edit and delete customer. After creating customer a confirmation email will automatically
                send to customer. You can add money to customer's database just like a bank account. You can also import
                customer with CSV file. <strong>You must follow the instruction to import data from CSV.</strong></p>
            <p>
                <img alt="" src="assets/images/customer1.png">
            </p>
            <p>
                <img alt="" src="assets/images/customer2.png">
            </p>
            <h2><strong>Add Biller</strong></h2>
            <p>Biller is the representative of your company. You may have multiple company and you want to manage all
                your inventory from a single platform. So this is a solution for enterprise. You can create, edit and
                delete biller. After creating biller a confirmation email will automatically send to biller. You can
                also import biller with CSV file. <strong>You must follow the instruction to import data from
                    CSV.</strong></p>
            <p>
                <img alt="" src="assets/images/biller1.png">
            </p>
            <h2><strong>Add Supplier</strong></h2>
            <p>Supplier is the people from whom you purchase products. You can create, edit and delete supplier. After
                creating supplier a confirmation email will automatically send to supplier. You can also import supplier
                with CSV file. <strong>You must follow the instruction to import data from CSV.</strong></p>
            <p>
                <img alt="" src="assets/images/supplier1.png">
            </p>
            <p>And you can search, export and print data from table that we discussed in <a href="#product">Product</a>
                section.</p>
        </section>
        <section id="reports">
            <div class="page-header">
                <h3>Reports</h3>
                <hr class="notop">
            </div>
            <p>You can create generate various reports automatically by using SaleProPOS.</p>
            <ul>
                <li><strong>Profit / Loss Report</strong></li>
                <li><strong>Best Seller Report</strong></li>
                <li><strong>Product Report</strong></li>
                <li><strong>Daily Sale Report</strong></li>
                <li><strong>Monthly Sale Report</strong></li>
                <li><strong>Daily Purchase Report</strong></li>
                <li><strong>Monthly Purchase Report</strong></li>
                <li><strong>Sale Report</strong></li>
                <li><strong>Payment Report</strong></li>
                <li><strong>Purchase Report</strong></li>
                <li><strong>Warehouse Stock Chart Report</strong></li>
                <li><strong>Product Quantity Alert Report</strong></li>
                <li><strong>User Report</strong></li>
                <li><strong>Customer Report</strong></li>
                <li><strong>Supplier Report</strong></li>
                <li><strong>Due Report</strong></li>
            </ul>
        </section>
        <section id="setting">
            <div class="page-header">
                <h3>SETTINGS</h3>
                <hr class="notop">
            </div>
            <h2><strong>Add Role</strong></h2>
            <p>You can create, edit and delete user roles. You can controll user access by changing the role permission.
                So, under a certain role users have specific access over this software</p>
            <p>
                <img alt="" src="assets/images/role1.png">
            </p>
            <h2><strong>Add Warehouse</strong></h2>
            <p>You can create, edit and delete warehouse. You can also import warehouse with CSV file. <strong>You must
                    follow the instruction to import data from CSV.</strong></p>
            <p>
                <img alt="" src="assets/images/warehouse1.png">
            </p>
            <h2><strong>Add Customer Group</strong></h2>
            <p>
                You can create, edit and delete customer group. Different customer group has different price over the
                product. You can modify this by changing price percentage in Customer Group module.
            </p>
            <p>
                You can also import customer group with CSV file. <strong>You must follow the instruction to import data
                    from CSV.</strong>
            </p>
            <p>
                <img alt="" src="assets/images/customer_group1.png">
            </p>
            <h2><strong>Add Brand</strong></h2>
            <p>You can create, edit and delete product brand. You can also import brand with CSV file. <strong>You must
                    follow the instruction to import data from CSV.</strong></p>
            <p>
                <img alt="" src="assets/images/brand1.png">
            </p>
            <h2><strong>Add Unit</strong></h2>
            <p>You can create, edit and delete product unit. You can also import brand with CSV file. <strong>You must
                    follow the instruction to import data from CSV.</strong></p>
            <p>
                <img alt="" src="assets/images/unit1.png">
            </p>
            <h2><strong>Add Tax</strong></h2>
            <p>You can create, edit and delete different product tax. You can also import tax with CSV file. <strong>You
                    must follow the instruction to import data from CSV.</strong></p>
            <p>
                <img alt="" src="assets/images/tax1.png">
            </p>
            <p>And you can search, export and print data from table that we discussed in <a href="#product">Product</a>
                section.</p>
            <h2><strong>General Settings</strong></h2>
            <p>You can change Site Title, Site Logo, Currency, Time Zone, Staff Access, Date Format and Theme Color from
                general settings</p>
            <h2><strong>User Profile</strong></h2>
            <p>You can update user profile info from this module</p>
            <h2><strong>POS Settings</strong></h2>
            <p>You can set your own POS settings from this module. You can set default customer, biller, warehouse and
                how many Featured products will be displayed in the POS module. You have to set your
                <strong>Stripe</strong> public and private key for Credit Card Payment. To implement payment with
                <strong>Paypal</strong> you have to buy live api from Paypal. You will also need to fillup the following
                information.
            </p>
            <p>
                <img alt="" src="assets/images/pos1.png">
            </p>
            <h2><strong>HRM Setting</strong></h2>
            <p>You can set default CheckIn and CheckOut time in HRM Setting.</p>
            <h2><strong>SMS Setting</strong></h2>
            <p>You can use Bulk SMS service via <strong>Twilio</strong> and <strong>Clickatell</strong>. You just have
                to fill the information correctly to activate this service. <strong>Please provide country code to send
                    sms.</strong></p>
        </section>
        <section id="translation">
            <div class="page-header">
                <h3>TRANSLATION</h3>
                <hr class="notop">
            </div>
            <p>Right now this software is supported in 11 language.</p>
            <ul>
                <li>English</li>
                <li>Spanish</li>
                <li>French</li>
                <li>Arabic</li>
                <li>Portugeese</li>
                <li>German</li>
                <li>Dutch</li>
                <li>Hindi</li>
                <li>Italian</li>
                <li>Russian</li>
                <li>Turkish</li>
            </ul>
            We hope that in future this software will be supported in more other languages. You can convert this
            software in your preferable language by simply changing the language option.</p>
            <p>
                <img alt="" src="assets/images/translation.png">
            </p>
            <p>If you are not satisfied with our translation go to resources/lang and open your desired language folder
                and edit the file.php.</p>
            <p>Special thanks to <strong>Dhiman Barua</strong> who made these translation files for our respected
                customers.</p>
        </section>
        <section id="video_tutorial">
            <div class="page-header">
                <h3>VIDEO TUTORIAL</h3>
                <hr class="notop">
            </div>
            <p>
                <iframe allowfullscreen="" frameborder="0" height="315" src="https://www.youtube.com/embed/-C0Rk5Fae4I"
                    width="560"></iframe></p>
        </section>
        <section id="support">
            <div class="page-header">
                <h3>SUPPORT</h3>
                <hr class="notop">
            </div>
            <p>
                Thanks a lot for using this user friendly software. Hope you found this documentation helpful for using
                this software. Please support this product by giving your ratings and testimonial.</p>
            <p>
                With best wishes - <a href="http://lion-coders.com">LionCoders</a>
            </p>
        </section>
    </div>
    <script type="text/javascript">
        $("#documenter_sidebar").mCustomScrollbar({
            theme: "light",
            scrollInertia: 200
        });
    </script>
</body>

</html>