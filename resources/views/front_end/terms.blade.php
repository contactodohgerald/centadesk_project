@php

$description = 'Centadesk is an online academic platform that consists of various sections to help users fit perfectly into the system based on their various knowledge bases and interest. The system was design to connect students with skill teacher/tutors in different works of life.';

$keyword = 'Website Development, Web Design, Web Site Designer, Android App Development, ICT Training, Web Designers in Nigeria, Computer Training Centers, Website Design Company, Digital Marketing Company, IT Consulting Firms, Nigeria, Web, Website, Content Writing, Advertisement, Branding, Web Hosting, Content Writing,';

$title = 'Terms and Condition | Make money while learning, teaching';
@endphp

@include('include.head')

<body class="yl-home">
   <div class="up">
      <a href="#" class="scrollup text-center"><i class="fas fa-chevron-up"></i></a>
   </div>

   @include('include.navigation')

   <section id="yl-slider" class="yl-slider-section pt-5 pb-5 mt-3">
       <div class="container">
           <div class="row">
               <div class="col-lg-8">
                   <div class="yl-section-title yl-headline">
                       <h2>{{ env('APP_NAME') }}- Terms and Conditions </h2>
                   </div>
               </div>
           </div>
           <div class="yl-department-content">
               <div class="row">
                   <div class="col-lg-3">
                       <img src="{{ asset('front_end/img/centadesk-terms-and-condition.svg') }}" alt="{{ env('APP_NAME') }} terms and condition">
                   </div>
                   <div class="col-lg-9">
                       <h4>
                           The following terms and conditions govern all use of the {{ env('APP_NAME') }}.com website, including any use or viewing of any Content (defined below), services and products available at or through the Platform by Platform visitors and participants, both unregistered and registered. The Platform is owned and operated by {{ env('APP_NAME') }}. The Services are offered to each User subject to such User’s acceptance of all of these Terms & Conditions and all other applicable terms and conditions, operating rules, policies and procedures that are communicated from time to time on or through the Platform by {{ env('APP_NAME') }}.<br><br>
                           A User should read the T&Cs carefully before browsing or accessing the Platform or any Content or using any Services. By browsing, accessing or using any part of the Platform, including the registration by a Registered User to open an account (a “User Account”), a User agrees to be bound by these Terms & Conditions. If a User disagrees with or cannot follow these Terms & Conditions (in part or in whole), then such User should not browse or access the Platform, use any Services or register to create a User Account.

                       </h4>

                       <h4>
                           <br>
                           <h1><u>Terms and Conditions --</u></h1>
                           <h3>Course Enrollment and Duration Access</h3>
                           <h4>When you enroll in a course, you get a license from us to view it via the {{ env('APP_NAME') }}Services and no other use. Don’t try to transfer or resell courses in any way. We grant you a 1 year access license, except when we must disable the course because of legal or policy reasons.<br>
                           Under our Instructor Terms, when instructors publish a course on {{ env('APP_NAME') }}, they grant {{ env('APP_NAME') }}a license to offer a license to the course to students. This means that we have the right to sublicense the course to the students who enroll in the course. <br>
                           As a student, when you enroll in a course, whether it’s a free or paid course, you are getting a license from {{ env('APP_NAME') }}to view the course via the {{ env('APP_NAME') }}platform and Services, and {{ env('APP_NAME') }}is the licensor of record. Courses are licensed, and not sold, to you. This license does not give you any right to resell the course in any manner (including by sharing account information with a purchaser or illegally downloading the course and sharing it on torrent sites).<br>
                           In legal, more complete terms, {{ env('APP_NAME') }}grants you (as a student) a limited, non-exclusive, non-transferable license to access and view the courses and associated content for which you have paid all required fees, solely for your personal, non-commercial, educational purposes through the Services, in accordance with these Terms and any conditions or restrictions associated with a particular courses or feature of our Services.<br>
                           All other uses are expressly prohibited. You may not reproduce, redistribute, transmit, assign, sell, broadcast, rent, share, lend, modify, adapt, edit, create derivative works of, sublicense, or otherwise transfer or use any course unless we give you explicit permission to do so in a written agreement signed by a {{ env('APP_NAME') }}authorized representative. This also applies to content you can access via any of our APIs if any.<br>
                           We generally give a 1 year access license to our students when they enroll in a course. However, we reserve the right to revoke any license to access and use courses at any point in time in the event where we decide or are obligated to disable access to a course due to legal or policy reasons, for example, if the course you enrolled in is the object of a copyright complaint, or if we determine its content violates our Trust & Safety Guidelines. <br>
                           The 1 year access is not applicable to add-on features and services associated with a course. For example, translation captions of courses may be disabled by instructors at any time, and instructors may decide at any time to no longer provide teaching assistance or Q&A services in association with a course. To be clear, the 1 year access is to the course content but not to the instructor.<br>
                           Instructors may not grant licenses to their courses to students directly, and any such direct license shall be null and void and a violation of these Terms.
                           </h4><br>
                       <h3>Payments, Credits, and Refunds</h3>
                       <h4>
                           When you make a payment, you agree to use a valid payment method. You are to watch the demo course and read up the description before making payment or purchasing a course, one’s payment is made {{ env('APP_NAME') }}do not refund. Remember this is a community based system and the courses you purchase also serve as a gateway for you to use the platform for a one year duration. So the payment is not only applicable for the course you are purchasing but it also serve as a mean for you to gain access to the platform.
                           </h4><br>
                       <h3>Pricing</h3>
                       <h4>
                           The prices of courses on {{ env('APP_NAME') }}are determined based on the terms of {{ env('APP_NAME') }}and our Promotions Policy. In some instances, the price of a course offered on the {{ env('APP_NAME') }}is completely determined by the platform as the platform is a community based platform and each participant has a fair share on the course fees based on their personal activities.<br>
                           If you are logged into your account, the listed currency you see is based on the platform accepted currency when you created your account. The major currency on the platform is dollar and Bitcoin, but other payment means might also be available on the platform.
                           </h4><br>
                       <h3>Membership</h3>
                       <h4>
                           {{ env('APP_NAME') }}is a network marketing platform and it is community base that mean joining is not free. To be an active member in {{ env('APP_NAME') }}you must
                           </h4><br><h4>
                           1.	Crate account through the registration page and confirm your personal details like email/phone number
                           </h4><br><h4>
                           2.	Enroll for a particular course or buy a license buy simply subscribing for a course on the platform to unlock your membership and other benefits both students/teachers/agents are to follow the one process to become an active member of the platform. Note this license is for a period of one year after which the user may choose to renew or discontinue using the platform.<br>
                           Rights to Content You Post
                           You retain ownership of content you post to our platform, including your courses. We’re allowed to share your content to anyone through any media, including promoting it via advertising on other websites.<br>
                           The content you post as a student or instructor (including courses) remains yours. By posting courses and other content, you allow {{ env('APP_NAME') }}to reuse and share it but you do not lose any ownership rights you may have over your content. If you are an instructor, be sure to understand the course licensing terms.<br>
                           When you post content, comments, questions, reviews, and when you submit to us ideas and suggestions for new features or improvements, you authorize us to use and share this content with anyone, distribute it and promote it on any platform and in any media, and to make modifications or edits to it as we see fit.<br>
                           In legal language, by submitting or posting content on or through the platforms, you grant us a worldwide, non-exclusive, royalty-free license (with the right to sublicense) to use, copy, reproduce, process, adapt, modify, publish, transmit, display, and distribute your content (including your name and image) in any and all media or distribution methods (existing now or later developed). <br>This includes making your content available to other companies, organizations, or individuals who partner with {{ env('APP_NAME') }}for the syndication, broadcast, distribution, or publication of content on other media, as well as using your content for marketing purposes. You also waive any rights of privacy, publicity, or other rights of a similar nature applicable to all these uses, to the extent permissible under applicable law. You represent and warrant that you have all the rights, power, and authority necessary to authorize us to use any content that you submit. You also agree to all such uses of your content with no compensation paid to you.<br>
                           These T&Cs include the following sections:<br>
                           1.	Platform general description<br>
                           2.	Categories of Users<br>
                           3.	 User Registration with the Platform<br>
                           4.	Specific provisions for Content hosted on the Platform<br>
                           5.	General rules for User generated Content<br>
                           6.	Legal nature of the Platform - Disclaimers – Limitation of Liability<br>
                           7.	Notice & take down process – Report to competent authorities<br>
                           8.	Intellectual Property<br>
                           9.	Termination<br>
                           10.	Confidentiality<br>
                           11.	Indemnification<br>
                           12.	Applicable Law and Jurisdiction<br>
                           13.	Miscellaneous<br>
                           </h4><br>
                       <h3>1. Platform General Description</h3>
                       <h4>
                           1.1 Welcome to the {{ env('APP_NAME') }}, the largest online community for the “{{ env('APP_NAME') }}.com” market, created as an informative, educational, earning and knowledge-sharing platform targeted mainly to the general public with the aim to provide Content and Services to enable Users to:
                           </h4><br><h4>
                           1.1.1 access an online platform where Users can stay up to date with the latest industry news and technologies as well as have access to educational and informative material—including, for instance, the ability to read industry-related articles and eBooks; participate in webinars; find projects, events or job; and participate in other activities offered on the Platform;
                           </h4><br><h4>
                           1.1.2 share/post Content created by the Company
                           </h4><br><h4>
                           1.1.3 share/post free and sponsored third-party Content (i.e., Content not created by the Company, which is referred to as “User Generated Content”) to be hosted in the Platform related to the e-Learning market and industry;
                           </h4><br><h4>
                           1.1.4 Connect with e-Learning market professionals and businesses;
                           </h4><br><h4>
                           1.1.5 Receive promotional news and information;
                           </h4><br><h4>
                           1.1.6 Promote products and services that are related to the e-Learning market and industry;
                           </h4><br><h4>
                           1.1.7 Have access to additional paid Services provided by the Platform (collectively, “Additional Services”), which Additional Services may be purchased under separate orders or agreements with the Company (Purchase T&Cs); and
                           </h4><br><h4>
                           1.1.8 Earn through the company affiliate programs.
                           </h4><br><h4>
                           1.2 Content hosted on the Platform: The Content hosted on the Platform can be distinguished as follows (all such content, including Company created content and User Generated Content is referred to collectively herein as “Content”):
                           </h4><br><h4>
                           1.2.1 {{ env('APP_NAME') }}Content: The Platform hosts its own Content, including Videos, Articles, eBooks, Webinars and other items it creates.
                           </h4><br><h4>
                           1.2.2 Third party Content hosted on the Platform: The Platform hosts User Generated Content that is contributed by Registered Users (which User Generated Content is not controlled by the Company);
                           </h4><br><h4>
                           1.2.3 Third-party Sponsored Content: Sponsored Content is paid Content contributed by Registered Users that promotes (directly or indirectly) products and services of professionals and businesses operating in the e-Learning market and industry. Promotional Content is posted subject to payment of the relevant fees by Registered Users under the terms and conditions set forth in these T&Cs as well as additional terms and conditions applicable for the purchase of such Additional Services as set forth in the purchase terms (“Purchase T&Cs”).<br>
                           Sponsored Content includes the following types of Content:<br>
                           •	Video Tutorials<br>
                           •	promotional Articles,<br>
                           •	commissioned Articles,<br>
                           •	promotional Directory listings,<br>
                           •	Event advertisements,<br>
                           •	Press Releases,<br>
                           •	Job postings,<br>
                           •	eBooks and<br>
                           •	Webinars.
                           </h4><br><h4>
                           1.2.4 All User-Generated Content must contribute to and be consistent with the informative and educational nature of the Platform regarding the e-Learning market and must follow the general rules of the company as well as any specific rules and guidelines provided in the Platform, including at the point of submission of the Content and/or the purchase of the related hosting Services. The Platform is not involved in any way in the creation of User Generated Content nor does the Company control or initiate User Generated Content. <br>Unless otherwise provisioned in the applicable Terms and/or the Purchase T&Cs, the Company reserves the right (but is under no legal or statutory obligation) to conduct a preliminary review of such Content as provisioned in article 5.3. <br>Below and may refuse to post any Content that the Company determines violates or is against the rules or policies of the Platform and/or applicable law. In any case the Platform reserves the right to delete or suspend any Content when it comes to our attention (including but not limited further to a Takedown Notice described in article 7 below) that any Content violates any of our standards or these T&Cs. The Company’s policies aim at ensuring the Platform’s primary nature as an online community and a knowledge-sharing informative Platform of lawful Content for the eLearning market professionals.
                           </h4><br><h4>
                           1.2.5 Throughout these T&Cs there are references to instances where there may be links to third party websites. For any link to any third party website, we have no control over the contents of those sites or resources and accept no responsibility for them or for any loss or damage that may arise from a User’s use of any such third party website. If a User decides to access any third party website, it is done at the User’s own risk.
                           </h4><br>
                       <h3>2. Categories of Users</h3>
                       <h4>
                           General Notes: The Platform’s Content is mainly targeted at the general public those who are willing to learn and also those willing to train interested trainees. Some parts of the Platform require a User to register, make payment and create a User Account in order to preliminarily verify the user’s membership status. Please note, however, that the Platform is not able (and is under no legal or statutory obligation) to confirm or warrant the professional status of any User nor of the correctness, accuracy and the truth of any User’s data.
                           <br>The registration process is used only as a basic verification mechanism to potentially discourage non-active Users as well as to avoid registrations by malicious systems and bots to the extent possible. Overall, the purpose of such registration is to enhance, the reliability of the Platform as a professional knowledge sharing community and to promote the goals of the Platform.<br>
                           Users can be divided into the following categories, depending on the Content they can access and/or contribute, as well as their purchase of Additional Services from the Platform:
                           </h4><br><h4>
                           2.1 Users: All Users visiting the Platform, can browse the Platform and have access to informative Content. Where the Content posted on the Platform is sponsored by contributors, we will identify that such Content is sponsored. All Users can access Articles, comments, reviews, Directory listings, Events, Press Releases and Job postings.
                           </h4><br><h4>
                           2.1.0 Registered Users: Registered Users are Users who register and create a User Account with the Platform in order to have access to more advanced informative and educational material as well as to be able to contribute Content to the Platform. Registered Users can:
                           </h4><br><h4>
                           2.1.1 pay and obtain/unlock access to earning means;
                           </h4><br><h4>
                           2.1.2 contribute/upload informative, marketing/promotional Content to the Platform,
                           </h4><br><h4>
                           2.1.3 download videos, eBooks and Webinars hosted on the Platform of the paid package;
                           </h4><br><h4>
                           2.1.4 submit Reviews; and
                           </h4><br><h4>
                           2.1.5 join affiliate programs;
                           </h4><br><h4>
                           2.3 Clients: (“Client Users” or “Clients”) are Registered Users who purchase any of the Additional Services provided from the Platform from time to time as provisioned in the Purchase T&Cs.
                           </h4><br>
                       <h3>3. User Registration with the Platform</h3>
                       <h4>
                           3.1 To register with the Platform and create a User Account, a User may either:<br>
                           3.1.1 register on-site, by filling in certain personal details (name and e-mail address); a User is then required to confirm registration by clicking on an activation link which is sent to the User at the email provided, for verification purposes the subscribe to any course on the platform to retain it membership on the platform within one year or lose it after one week of none payment or subscription to a course; or
                           </h4><br><h4>
                           3.2 Upon registering to the Platform, a Registered User creates: i) a User Account, including the above mandatory personal data and ii) a User Profile where each registered User can provide any personal data it wishes to voluntarily provide. More specifically:
                           </h4><br><h4>
                           3.2.1 “User Account”: is only used by the Platform for internal purposes (relationship between the User and Platform)—Some User Account data like (name, social media links, whatsapp number) may be visible in the users public profile to other Users and is not transferred to any third party.
                           </h4><br><h4>
                           3.2.2 “User Profile”: is the profile that the User wishes to have in the Platform, which may be visible to other Users. Each User can decide what information to include in the User Profile and the extent such information will be visible to the public and other Users. However, note that for some actions it might be necessary to make the User Profile visible to other Users and reveal some User Profile data depending on the nature of the Content uploaded by the User (for example data necessary for Content reliability and attribution purposes).
                           </h4><br><h4>
                           3.3 (a) Where a Registered User is a legal entity, the natural person that opens the User Account on behalf of such Registered User warrants that he/she has the legal capacity and power to <br>(i) act on behalf of and to represent the specific legal entity/Registered User, <br>(ii) proceed with the registration of the User to the Platform and the creation of the User Account and the User Profile, <br>(iii) accept the present Terms and Conditions and all other policy and informative documents in the Platform (including but not limited the warranties, declarations and assignments undertaken from time to time by the Registered Users) and <br>(iv) provide orders (such as indicative purchase orders) and to make payments to the Platform on behalf of and in the name of the registered legal entity.<br>
                           (b) Where a Registered User is a legal entity represented by another legal entity (i.e. a Marketing Agent or other agent—the “Agent”), the Agent acting through the natural person that creates the User Account and the User Profile on behalf of the Registered User-legal entity provides the same warranties and representations as above. The same warranties and representations apply in case an Agent acts on behalf of diverse legal entities and/or professionals through its (the Agent’s) Account.<br>
                           In both a) and b) above, the legal entity registered as a Registered User and/or Client shall be responsible and liable towards the Company/Platform for all of the above as further provided in article 3.8 below.
                           </h4><br><h4>
                           3.4 Users understand and acknowledge that they should provide the Platform only with data and information that is true, accurate and updated, as well as lawfully acquired and to keep this data and information accurate, true and updated at all times (and make any changes/updates necessary by using the appropriate settings in their User Account and/or User Profile). The Platform does not necessarily audit nor verify any of the data provided. However, the Platform reserves the right (but is under no obligation) to ask for more information from the Registered User and/or to seek clarifications regarding specific information and/or to refuse registration and/or to suspend or delete any User Account and Profile if any violation of the above comes to the Company’s attention. In any event, Users agree to hold harmless and bear full responsibility for all damages accrued to the Company in case of violation of the above obligations. Other Users or third parties can submit a complaint with regard to untrue or fault third party data following the Notice and Take Down Process of article 7. Processing of User’s personal data is subject to the terms of our Privacy Policy.
                           </h4><br><h4>
                           3.5 The Platform reserves the right to refuse to open a User Account and/or to refuse any Content submitted by a Registered User, and/or to delete or suspend the User Account and the related User Profile if it comes to the attention of the Platform and/or if it is notified by a third party that the Registered User is not a real and/or the User Account/Profile has fake or false or non-accurate data, at any time. Also, the Platform reserves the right to terminate the User Account as provided in article 9 below.
                           </h4><br><h4>
                           3.6 Account name and Password:<br>
                           3.6.1 Registration on-site: If a User signs up on site in the Platform, his/her registered email shall automatically become the account name; the User cannot change it any time with another account name/email. This practically means that, the e-mail address is tie to the account. Τo complete the creation of the personal User Account, The User shall generate a password to secure his or her account. Users are advised to regularly change the password for security reasons; Users should also avoid using the same and/or easily detectable password(s) by introducing, where possible, not only letters and numbers, but also symbols in multiple combinations. In the event the User forgets the password, he/she may select the relevant “Forgot my Password” field and instructions will be sent to the User’s email in order to change the password. The account name and password shall identify uniquely each User in the Platform.
                           </h4><br><h4>
                           3.6.2 Each User Account and User Profile are personal and non-transferable. Each Registered User is responsible to retain the secrecy and non-disclosure of such Use’s password from third parties. The Platform also highly recommends that a Registered User not allow the access and use of its User Account and User Profile by any third party and not to share their secret password with anyone else.
                           </h4><br><h4>
                           3.7 Any act and/or omission through the User Account (including, but not limited to, the posting of Content, reviews, comments etc., the provision of information in the User Account, the submission of a takedown notice, the submission of a purchase and/or payment order etc.) shall be reasonably considered by the Platform as the act and/or omission of the Registered User, conducted with the Registered User’s prior approval and shall be binding on that Registered User. Each Registered User is solely responsible for the safety of his/her User Account and User Profile as well as for any loss or damage occurred to the User and/or to a third party and/or to the Platform from the use of that User Account up to the moment the User explicitly notifies us, through support, of any unauthorized access and/or use of his/her Account or any other breaches of security. This notification applies for any subsequent use. We will not be liable for any acts or omissions by Users, including any damages of any kind incurred as a result of such acts or omissions and, where applicable, shall reasonably rely on the warranties and representations of the User referred to in 3.4. above.
                           </h4><br><h4>
                           3.8 Deletion of a User Account:<br>
                           3.8.1 If a Registered User wishes to delete the Registered User’s applicable User Account, such Registered User may e-mail the Platform through support with a request to delete the User Account. As soon as the User Account is deleted the associated User Profile will also be automatically deleted. Following such a request, we will permanently delete the User Account, as well as any data contained in the User Account and in the User Profile and all Content the User has submitted to the Platform as a Registered User, within fifteen (15) days from the submission of the User’s deletion request. The provisions of article 9 below also apply.
                           </h4><br><h4>
                           3.8.2 A Registered User acknowledges that by submitting a request to delete the applicable User Account, we will permanently delete the User’s data and Content hosted in the Platform as well as any other data hosted in the applicable User Account on behalf of the Registered User and that such User will no longer be able to retrieve such information. The Platform shall not be liable for any damages caused from this deletion of the data and Content.
                           </h4><br><h4>
                           3.8.3 If a User has purchased Additional Services, the deletion of the User Account might not allow the execution or the continuance of some Additional Services, if in order to receive those Services it is necessary to have an active User Account. In this context, the Purchase T&Cs for the provision of Additional Service would apply as well, as provided in the purchase terms.
                           </h4><br><h4>
                           3.8.4 We reserves without limitation the right to suspend and/or delete any User Account and User Profile according to the provisions of the Terms and Conditions, including but not limited to the provisions of article 9.4 below as well as the applicable overall Purchase T&Cs (in case of Additional Services); all other provisions of the present article shall apply respectively.
                           </h4><br>
                       <h3>4. Specific Provisions For Content Hosted On The Platform</h3>
                       <h4>
                           4.1 Articles:<br>
                           4.1.1 Access and reading of Articles:
                           (a) All Users can access and read articles hosted in the Platform subject however to their User category as laid down in articles 2.1.-2.3. Above; these articles are created by the Platform or by the Registered Users (as free or sponsored User Generated Content)
                           <br>(b) Users can generally browse the articles by category and topic; at the end of each article Users may also find tabs with proposed topics related to the topic of the chosen article in order to re-direct to the suggested article category in the Platform or other relevant Content.
                           <br>(c) Articles remain available to the Platform for as long as the Registered User/author of the article maintains an active User Account.
                           4.1.2 Ability to post Articles for free and/or sponsored:
                           <br>(a) Registered Users can submit non-promotional articles of generic informative nature for the e-Learning market to be uploaded in the Platform for free as User Generated Content as provisioned in article 1.2.2 above.
                           <br>(b) Unless otherwise provided in the Platform or herein, submitted articles must be original and have not been published previously through the Registered User’s or any other third party’s digital means (e.g. platform, blog, website, social media account, or similar mediums).
                           <br>(c) 10 business days after the posting of an original Article in the Platform, a Registered User can then re-publish/upload that article through its own or third party digital means (e.g. platform, blog, website, social media account etc.)—the applicable period of time shall be determined based on the specific guidelines provided by the Platform.
                           <br>(d) When a Registered User posts an Article, its User Profile data will become visible to other Users for attribution and credibility purposes. Each Registered User though has control over the volume and the type of data to be included in the User Profile as mentioned in article 3.3.2 above.
                           <br>(e) Registered Users who wish to upload sponsored, promotional articles, must become a Teacher/Instructor and purchase a package to allow such access.
                           </h4><br><h4>
                           4.2 Ability to submit Comments:<br>
                           4.2.1 All Users may read and post (as User Generated Content) comments on any Article (free or sponsored) hosted in the Platform.
                           </h4><br><h4>
                           4.2.2 To post comments, a User is required to have a User Account in the Platform; a User must maintain that account in order for the applicable comment to remain visible on the Platform. It is noted that if a User deletes his/her account, any comments posted in the Platform could be also deleted and no longer be visible on the Platform either.
                           </h4><br><h4>
                           4.2.3 The Company reserve the right to review the comments Users upload in the Platform. However comments must also follow the rules set in article 5 below and Platform reserves the right to delete a comment if it determines in its discretion that there is a violation, in case it receives a Takedown Notice pursuant to article 7 herein, or for any reason it determines.
                           </h4><br><h4>
                           4.3 eBooks:<br>
                           4.3.1 e-Books are either created by the Platform or sponsored by Clients (as sponsored User Generated Content).
                           </h4><br><h4>
                           4.3.2 Registered Users can only upload eBooks subject to payment of a subscription fee. Those who are interested in uploading an e-Book can click to purchase the relevant paid hosting service, which is subject to the Purchase T&Cs. A Client who uploads an e-Book is referred to as a “Teacher/Instructor.”
                           <br>(a) Access and downloading of eBooks
                           </h4><br><h4>
                           4.3.3 The content of e-Books is addressed to individuals who are interested in being further informed and to learn additional details with regard to processes, services and products available in the platform. In order to ensure, to the extent possible, that only will have access to such e-Books, access is limited to only Registered Users as provisioned in article 3 above.
                           <br>(b) Special rules applicable for e-Books created by Teachers/Instructors and hosted in the Platform
                           </h4><br><h4>
                           4.3.4 Registered Users can download eBooks created by Teachers/Instructors that are posted in the Platform. eBooks are hosted in the Platform for a specific period of time and are available for as long as the Teachers/Instructors has an active subscription with the platform. After the lapse of such period, the eBook will no longer be available for downloading from the Platform.
                           </h4><br><h4>
                           4.3.5 eBooks are either Premium eBooks, created originally for the Platform, or Imported eBooks, i.e. eBooks that Clients republish in the Platform. Users can browse eBooks by topic category and/or other available criteria.
                           </h4><br><h4>
                           4.3.6 A Registered User will receive an e-mail from the Platform, on behalf of the Teacher/Instructor, informing the Registered User about the download and how best to assist him/her in learning.
                           <br>(c) Special rules applicable for e-Books created by the Platform
                           </h4><br><h4>
                           4.3.7 Registered Users can download eBooks created by the Platform after they must have subscribe to the particular course.
                           </h4><br><h4>
                           4.3.8 In order to download a Platform eBook, the Platform might request the Registered User to provide additional personal data for communication purposes. Prior to providing any information to the Platform, Registered Users must read and accept the applicable Privacy Policy. Registered Users shall determine the data they wish to provide to the Platform; those data are independent from the data provided to the Platform for the creation of the User Account and the User Profile in the Platform.
                           </h4><br><h4>
                           4.5 Jobs:<br>
                           4.5.1 Platform operates a “Job Openings” section. Registered Users can publish their job listings to find candidates for their Job Openings subject to payment of the relevant fee (sponsored User Generated Content). Those who are interested in uploading a job listing can purchase the relevant paid hosting service.
                           </h4><br><h4>
                           4.5.2 Users can search for a Job Opening to which they can apply for free. In order to search for a job that matches their criteria, Users can apply certain filters (e.g. industry, level of education, employment type, functions etc.). Users can then directly submit their application to the relevant Clients under the applicable terms and conditions of each Client. A Job listing shall be available on the Platform at the applicable Client’s discretion (Client’s contact details shall be available for as long as the Client has an active listing contract with the Platform). Clients can delete a Job Opening listing, at any time, by contacting support.
                           </h4><br><h4>
                           4.5.3 Platform provides this Job Opening section as an open forum where the Users may find companies/Clients offering jobs that match their criteria and, accordingly, companies/Clients may find candidates for their job openings. Platform does not guarantee that Users will find a job opening that matches their criteria and/or that they will be hired by any company/Client searching for candidates to fill their job openings nor does it participate in the recruitment process. Also, Platform is not responsible for the duration of the job opening and if the job has been covered.
                           </h4><br><h4>
                           4.6 Reviews:
                           <br>(a) Registered Users can submit a review of a product or service which is listed and appears in the Directory in order to assess specific criteria and features of the products and services listed included in the relevant questionnaire.
                           <br>(b) In order to ensure the validity and truth of the reviews, the following shall apply:
                           <br>(i) Registered Users who want to submit reviews shall be required to provide additional information regarding the use of the product/service under review. Platform will process and host such information only for the above purpose and according to the terms of our Privacy Policy.
                           <br>(ii) Portions of the Registered User’s Profile User data shall be visible to the public along with its review. The platform shall extract automatically the ratings provided by the Registered Users based on the information provided in the reviews by Users and the Platform disclaims and is not liable for any inaccuracy and/or fault of the ratings.
                           </h4><br><h4>
                           4.7 Events:<br>
                           4.7.1 The Platform operates an Event listing section. Registered Users can publish Events that are relevant to the platform, (including for example scheduled conferences, congresses, events, seminars, symposiums, and workshops) in the Events section, subject to payment of the relevant fee for sponsored User Generated Content. Registered Users who are interested in uploading an Event can click to purchase the relevant paid hosting service where applicable.
                           </h4><br><h4>
                           4.7.2 All Users can access information about Events and browse Events by category and/or other available criteria.
                           </h4><br><h4>
                           4.7.3 Registered Users sponsoring Events are responsible for the lawfulness of the Events and of the accuracy and truth of all information provided. The Platform shall in no manner be responsible or liable for the availability of any tickets and/or seats and/or places for any Event, including if the Event is cancelled and/or rescheduled.
                           </h4><br><h4>
                           4.7.4 Events may include links to third party websites which include Content for which the platform has no control or liability. Where links are provided to third party websites, Users are redirected directly to that third party’s website and content, outside of the Platform’s environment and hosting services.
                           </h4><br><h4>
                           4.7.5 Registered Users who want to post an Event can click to purchase a paid hosting account if necessary. In order to post an Event, the Registered User must follow the general guidelines as will be available as well as the specific guidelines provided from the Platform at the point of submission of the event. Registered Users can delete their Events listing, at any time, by contacting support.
                           </h4><br><h4>
                           4.8 Press releases:<br>
                           4.8.1 The Platform operates a Press Releases section. Registered Users can publish their press releases that are relevant to the platform, subject to payment of the relevant fee (sponsored User Generated Content). Those who are interested in uploading a Press Release can click to purchase the relevant paid hosting service
                           </h4><br><h4>
                           4.8.2 All Users can access Press Releases posted by Platform’s Clients in the Press Releases section.
                           </h4><br><h4>
                           4.8.3 The Press Releases may include links to third party websites, for the Content of which we has no liability. Where links are provided to third party websites, Users are redirected directly to that third party’s website, outside of the Platform’s environment; in that case, no third party content is hosted in the Platform.
                           </h4><br><h4>
                           4.8.4 Registered Users who want to post a Press Release can click to purchase a paid hosting. In order to submit a press release, the Client must follow the general guidelines of that will be made available as well as the specific guidelines provided from the Platform at the point of submission of the Press Release. Registered Users can delete their Press Releases, at any time, by contacting support.
                           </h4><br><h4>
                           4.9 Newsletters:<br>
                           4.9.1 Users may subscribe to the Platform’s newsletter to receive news about updates from the Platform and from its Clients (consent). Newsletters may include news in general about the Platform and its Clients or news dedicated to a specific Client. Newsletters are sent on a daily or weekly basis, depending on the frequency selected by the User. Subscription to the newsletter is effective when the subscribing User activates the subscription link, he/she will receive at his/her email address after requesting to subscribe (confirmation of consent).
                           </h4><br><h4>
                           4.9.2 Each User can unsubscribe from the newsletter at any time, by clicking the “unsubscribe” button at the end of each newsletter.
                           </h4><br><h4>
                           4.9.3 To subscribe to the newsletter database, a User is required to provide a name and e-mail address, as well as some additional information for User segmentation purposes (to be submitted voluntarily from the Users).
                           </h4><br><h4>
                           4.9.4 Users can read more on how the Platform treats the data Users provide to it for subscription in the newsletters database of the Platform.
                           Articles in the newsletter may include links to third party websites and Content, for which we has no control over.
                           </h4><br><h4>
                           4.10 Ability to post Video:
                           <br>(a) Registered Users can post promotional videos to the platform otherwise been reviewed only registered instructors/Teacher who have activated there account through due process are allowed to submit promotional video.
                           <br>(b) Videos must follow certain rule and be examine by the platform team before been approved to be visible to the general public.
                           <br>(c) User my wish to host there video on a third party platform like YouTube and then supply such link to our platform for subscribers to download.
                           <br>(d) A compulsory one minute video of the teacher/instructor explaining each video will be necessary to that subscribers can have a feel of what they are about to subscribe to.
                           <br>(e) Registered Users who wish to upload sponsored, promotional videos, must apply to become a Teacher/Instructor and purchase a package to allow such access.
                           </h4><br>
                       <h3>5. General Rules for User Generated Content</h3>
                       <h4>

                           5.1 What can be posted?<br>
                           5.1.1 As already mentioned in article 2 above, Registered Users can upload to the Platform after subscribing as required by the platform “promotional” Content. Further, a Registered User submitting any Content must have the legal rights to submit such Content as contemplated by the Platform.
                           </h4><br><h4>
                           5.1.2 In case any Registered User wishes to upload any promotional Article (namely Content that promotes directly or indirectly the products and/or services of one or more professionals or businesses) it can purchase a paid hosting subscription as following:
                           </h4>
                       <br><h3>5.2 User responsibility for any type of Content submitted in the Platform:</h3>
                       <h4>
                           5.2.1 Each Registered User is responsible for any User Generated Content created and/or uploaded in the Platform by such User. We do not participate in the creation of such User Generated Content and does not initiate nor does it have any knowledge or control over any such User Generated Content. Registered Users must take all prudence not to upload any User Generated Content that contains illegal material (of any type) nor to create Content that could result in any illegal act or omission (of any type) nor violate the Terms and Conditions nor any other guidelines posted in the Platform and declaration undertaken by the Registered User with regard to the Content.
                           </h4><br><h4>
                           5.2.2 By submitting any Content to upload to the Platform, the User represents, warrants and agrees as follows:
                           <br>(a) All Content submitted for posting in the Platform does not infringe third party rights; the User is in compliance with and shall comply with all laws, rules and regulations applicable to the use of the Platform and the uploaded Content, including but not limited to applicable copyright and data protection laws;
                           <br>(b) The User is either the copyright owner of the Content being uploaded or has the lawful right to upload such Content to the Platform and to provide a license agreement to the Platform in order to host the Content and make it available to the public through the Platform without territorial or other limitations, as well as to other social media accounts owned by the Company (indicatively LinkedIn, Facebook, Twitter and Google+ and/or as is further and in specific provisioned in the Platform from time to time) under the provisions set forth herein.
                           <br>(c) The User acknowledges that the Content generated and posted represents the User’s views and opinions and not the Platform’s opinions or views and that the Platform does not necessarily endorse or agree with any such views and opinions by hosting the Content on the Platform;
                           <br>(d) The User is responsible to mention, where applicable, the sources of the Content as well as not to use content deriving from illegal sources. The terms of use of sources from which the User displays any links to third party Content should at least permit the reproduction without subscription or any other form of remuneration;
                           <br>(e) Where the Content includes the images and/or any other personal data of third parties (e.g. Webinar presenters), the Client is the sole responsible party to inform such third parties in detail about the use of their images and to ensure that the third parties have granted their free and informed consent to include the third party personal data in the content that the Client uploads in the Platform and to provide appropriate proof when so requested. The Client represents and warrants that all such permissions and licenses have been obtained or granted before uploading any Content.
                           <br>(f) Without limitation, the Registered User represents, warrants, agrees and guarantees that it shall not upload any Content (or link to any Content) nor proceed to any action in or through the Platform that is illegal. Indicatively and non-exhaustively, and will not post nor act in any way that:
                           <br>(i) infringes or violates another party’s intellectual property rights (such as content, music, videos, photos or other materials for which they do not have written authority from the owner of such materials to post on the Platform), including any party’s right of publicity or right of privacy; or
                           <br>(ii) promotes illegal or unauthorized copying of another person’s copyrighted work or links to them or providing information to circumvent security measures; or
                           <br>(iii) violates any law, statute, ordinance or regulation; or
                           <br>(iv) is threatening, harassing or that promotes racism, bigotry or hatred of any kind against any group or individual; or
                           <br>(v) promotes or encourages violence against a person or damage or destruction of property; or
                           <br>(vi) is inaccurate, false or misleading in any way; or
                           <br>(vii) promotes any illegal activities; or
                           <br>(viii) contains software viruses or any other computer code, files or programs designed to interrupt, destroy or limit the functionality of any computer software or hardware or telecommunications equipment; or
                           <br>(ix) contains any advertising, promotional materials, “junk mail,” “spam,” “chain letters,” “pyramid schemes,” or any other form of solicitation; or
                           <br>(x) infringes the personality right as well the right of privacy and/or protection of personal data; or
                           <br>(xi) promotes unfair competition and unfair commercial practices and/or violates competition rules
                           <br>(g) Notwithstanding the above, each User submitting Content further and more specifically guarantees that, where the submitted Content includes the images and/or any other personal data of third parties (overall “third party personal data”), such third parties have been informed in detail about the use of the Content and third party personal data on the Platform pursuant to the Platform’s Terms and Conditions and Privacy Policy and have granted their free and informed consent to include the third party personal data in the Content created or uploaded in the Platform. If so requested, Users shall promptly provide the Platform with any proof necessary to verify the above consent. The Platform reserves the right to take down or to request from the Users to take down any third party personal data indicated by a third party if that third party so notifies the Platform (third party opt-out). <br>Notwithstanding any other rights of the Platform, the same above applies in case that any third party notifies the Platform regarding the violation of the above from the Users.
                           <br>(h) When under the guidelines set by the Platform a Registered User must upload a new original Content (created especially for the Platform), the Registered User solemnly declares and represents and warrants that such Content is original and has not been previously posted or circulated.<br>
                           The above reflect solely examples of prohibited material and are not intended to be exhaustive of what constitutes prohibited User Generated Content.
                           </h4><br><h4>
                           5.2.3 Warranties and Liability of the User: By submitting any content to be uploaded in the Users warrant to the Platform compliance with the provisions of article 5.2.1. and 5.2.2. above, as well as with the terms of the present and with any other declarations and acknowledgements undertaken in the Platform from time to time. Each User acknowledges that he/she bears the responsibility to compensate, defend, hold harmless and exempt the Platform and its directors, officers, employees, consultants, representatives and affiliates from any, and all, claims by third parties’ liability, damages and/or costs (including, but not limited to legal consultants’ fees) which occur as a result of or in connection with the Content they upload or from the breach of the present terms or in case any other User or third party turns against the Platform in relation to any Content they have uploaded to the Platform or in connection to the use of the Platform or the services. In addition, Users acknowledge that they shall respect the notice and take down process of the Platform set in article 7.
                           </h4><br><h4>
                           5.3 Review of Content:<br>
                           5.3.1 Platform does not and is under no legal obligation to systematically monitor and/or review any Content created or uploaded in the Platform.
                           </h4><br><h4>
                           5.3.2 In some cases, in order to ensure that the Content the Users post on the Platform is in line with the Platform’s scope as an informative and educational online community of lawful content for the e-Learning market professionals, Platform conducts a preliminary high-level review of the Content. This review focuses mainly on assessing whether Content is consistent with the Platform’s purpose, that Content is legible and can be easily found by Users as well as to identify potential obvious infringements. Such high-level screening is in principle automated, based on general predefined rules and guidelines provided to Users and includes:
                           <br>(a) assessing:
                               <br>(i) relevance to the topics within the platform, as analyzed above under paragraph 5.1;
                               <br>(ii) suitability for the Learning audience;
                               <br>(iii)  that the Content is not evidently self-promotional (i.e. principally with the purpose to market the products and/or the services of the Registered User) and does not solely serve promotional purposes.
                               <br>(iv) (where applicable) that the Content has not already been published on the User’s or third party’s digital means; and/or
                               <br>(v) that the Content is not obviously and evidently infringing any third party intellectual property rights or otherwise illegal or inappropriate. Without limiting the foregoing, any Content submitted by a User must not:<br>
                               <br>.	contain any defamatory, obscene, indecent, abusive, offensive, harassing, violent, hateful, inflammatory or otherwise objectionable material;
                               <br>.	promote sexually explicit or pornographic material, violence, or discrimination based on race, sex, religion, nationality, disability, sexual orientation or age;
                               <br>.	violate any party’s legal rights (including rights of publicity and privacy);
                               <br>.	contain any material that could result in civil or criminal liability;
                               <br>.	conflict with these T&Cs or any other applicable policy;
                               <br>.	be likely to deceive any person;
                               <br>.	advocate, promote or assist any illegal or unlawful activity;
                               <br>.	cause annoyance, inconvenience or needless anxiety or be likely to upset, embarrass, alarm or annoy any other person;
                               <br>.	impersonate any person, or misrepresent the identity or affiliation of the user or any other party;
                               <br>.	involve commercial activities or sales, such as contests, sweepstakes and other sales promotions, barter or advertising, other than as conducted by the Platform; or
                               <br>.	appear as if they are sent by or endorsed by us or any other person, if this is not the case.
                           <br>(b) Extracting metadata provided by Registered Users to help other Platform and Registered Users locate the Content.
                           <br>(c) Indexing and displaying links to related Content based on an automated algorithm.
                           <br>(d) For legibility and presentation purposes (indicatively, breaking-down the text into smaller paragraphs, adjusting the fonts and applying other formatting characteristics).<br>
                           It is specified that review of the Content by the Platform can include some or all of the above activities depending on the type of Content uploaded in the Platform. It is clarified that some parts of Content uploaded cannot be reviewed by the Platform such as (indicatively) the contents of a Webinar; the truth and accuracy of Events, Job Openings, Press Releases; or the links to third party websites and Content.
                           </h4><br><h4>
                           5.3.3 The Platform reserves the right to refuse to upload any Content that does not successfully pass the above high-level review in the Platform’s sole discretion. In addition, the Platform reserves the right (but is under no legal obligation) to make grammatical or spelling corrections to the Content. Any manual intervention that could be necessary is solely made to facilitate this typical check. In any case whatsoever, the above review, when conducted by the Platform is conducted notwithstanding the Users obligations and the guarantees undertaken by Users with regard to the Content as laid down in article 5.2. above and does not limit nor exclude in any way that liability of each User and his/her obligation to hold harmless the Platform in case of any breach or violation, as further described in article 6 below.
                           </h4><br><h4>
                           5.3.4 The Platform acts principally as the automated, technical and neutral host of the Content that is uploaded by Users. Any Content review of User Generated Content only aims to ensure that Content is coherent and consistent with the Platform’s purpose and to identify obvious infringement and we do not guarantee (nor control or initiate) the Content’s lawfulness and/or fitness for a specific purpose. Regarding the legal nature and the limitations of liability of the Platform article 6 below is applicable.
                           </h4><br>
                       <h3>6. Legal Nature of the Platform - Disclaimers – Limitation of Liability</h3>
                       <h4>
                           6.1 Legal nature of the Platform:<br>
                           6.1.1 In addition to hosting its own Content, the Platform principally acts as an intermediary service provider that: <br>(a) Hosts and stores information and data at the direction of its Users and <br>(b) Provides links or other tools for locating content online
                           </h4><br><h4>
                           6.1.2 Platform is also a provider of Additional Services including: <br>(a) consulting services and <br>(b) marketing tools
                           </h4><br><h4>
                           6.1.3 With regard to the Services referred to in article 6.1.1 the Platform acts as an intermediary information service provider that hosts information and data at the direction of its Users—the Platform does not control or solicit User Generated Content but allows Registered Users to upload such Content to promote the purposes of the Platform. In this context, Platform acts as the automated, technical and neutral host of the Content that is uploaded by Users. It is each User’s obligation to follow the strict rules of the Platform regarding copyright protection and lawful Content provision in general. Given the nature of the Platform and the Content, it is not possible for the Platform (and it is under no legal obligation) to constantly monitor the Content uploaded by User’s nor to actively seek facts or circumstances to confirm intellectual property rights and monitor for all inappropriate or illegal activity. However, the Platform intends to take reasonable precautionary measures (including but not limited to the measures specified under article 5.3 above and article 7 below) to prohibit obviously illegal activity.
                           </h4><br><h4>
                           6.1.4 It is clarified that except for Content it expressly creates, the Platform is not intended to act and should not be regarded as a publisher. To mitigate the possibility of inappropriate content, the Platform has put in place and apply the aforementioned reasonable precautionary measures and undertakes reasonable efforts not to post infringing, unlawful or undesirable Content. In addition as also mentioned in the present terms, the User Generated Content depicts the opinions and the views of the User/author which are not initiated, controller or endorsed by the Platform.
                           </h4><br><h4>
                           6.1.5 In any case whatsoever, in any Services provided by the Platform (including Additional Services), Platform does not conduct a comprehensive review of any Content, does not control nor initiate User Generated Content nor the actions of the User, nor does Platform guarantee (nor control or initiate) the Content’s nor any activities’ undertaken by the Users lawfulness and fitness for a specific purpose. <br>Although as part of consulting services the Platform may identify topics and areas of Content a User may wish to explore or publish on, it is ultimately the decision and action of the Registered User in determining what Content to create or upload. Each registered User uploads Content and conducts any activity in or through the Platform must make those representations, warranties and guarantees to the Platform as set forth in article 5.2 above and without any interference nor control by the Platform. All User Generated Content and actions undertaken by the Users express their own opinion and views and hosting of any Content is not an endorsement of any opinions and views expressed by the Users.
                           </h4><br><h4>
                           6.2 The Platform and the User Generated Content uploaded in it may contain hyperlinks (links) to third-party websites. Platform does not control nor review the Content of such links and bears no responsibility for the Content and the services of those third party websites, nor does it warrant the continuous and safe accessibility to them as laid down in article 1.2.5. above.
                           </h4><br><h4>
                           6.2.1 The Platform does not guarantee and is not responsible or liable for the accuracy, legitimacy, truth, reliability, quality, or adequacy for the intended purpose of the User Generated Content (both sponsored and free) uploaded in the Platform. Each User accesses the User Generated Content hosted in the Platform as well as any other third-party website at his /her own exclusive risk, subject to any terms or agreements with the providers of such Content or websites. In any case, we bears no responsibility for User Generated Content (both sponsored and free) hosted in the Platform, as well as the activities undertaken by Users through the Platform. Each User shall be fully liable for any Content created and distributed by such User (as laid down in article 5 above).
                           </h4><br><h4>
                           6.3 The Platform and the Services are provided “as is” and “as available” using a commercially reasonable level of skill and care. Except as expressly stated in these Terms & Conditions, The platform does not provide and expressly disclaims warranties, conditions or undertakings of any kind in relation to the Services, either express or implied, including, without limitation, warranties of merchantability and fitness for a particular purpose. No advice or information, whether oral or written, obtained by Users from us or through the Services will create any warranty not expressly stated or incorporated herein. Without limiting the foregoing, The platform, its subsidiaries, its licensors and affiliates, do not warrant that any Content is accurate, true, reliable, correct or complete.<br>
                           EXCEPT AS EXPRESSLY PROVIDED IN WRITING, A USER’S USE OF THE PLATFORM, ITS CONTENT AND ANY SERVICES THROUGH THE PLATFORM IS AT THE USER’S OWN RISK AND THE PLATFORM IS PROVIDED ON AN “AS IS” AND “AS AVAILABLE” BASIS, WITHOUT ANY WARRANTIES OF ANY KIND, EITHER EXPRESS OR IMPLIED. NEITHER COMPANY NOR ANY PERSON ASSOCIATED WITH COMPANY MAKES ANY WARRANTY OR REPRESENTATION WITH RESPECT TO THE COMPLETENESS, SECURITY, RELIABILITY, QUALITY, ACCURACY OR AVAILABILITY OF THE PLATFORM. WITHOUT LIMITING THE FOREGOING, NEITHER COMPANY NOR ANYONE ASSOCIATED WITH COMPANY REPRESENTS OR WARRANTS THAT THE PLATFORM, ITS CONTENT OR ANY SERVICES OR ITEMS OBTAINED THROUGH THE PLATFORM WILL BE ACCURATE, RELIABLE, ERROR-FREE OR UNINTERRUPTED, THAT DEFECTS WILL BE CORRECTED, THAT THE PLATFORM OR THE SERVER THAT MAKES IT AVAILABLE ARE FREE OF VIRUSES OR OTHER HARMFUL COMPONENTS OR THAT THE PLATFORM OR ANY SERVICES OR ITEMS OBTAINED THROUGH THE PLATFORM WILL OTHERWISE MEET YOUR NEEDS OR EXPECTATIONS.<br>
                           COMPANY HEREBY DISCLAIMS ALL WARRANTIES OF ANY KIND, WHETHER EXPRESS OR IMPLIED, STATUTORY OR OTHERWISE, INCLUDING BUT NOT LIMITED TO ANY WARRANTIES OF MERCHANTABILITY, NON-INFRINGEMENT AND FITNESS FOR PARTICULAR PURPOSE.
                           </h4><br><h4>
                           6.4 The platform agrees to undertake reasonable efforts and technical measures so that the Services and access to the Platform can take place smoothly and without interruption and that an adequate level of security is maintained. However, the platform does not guarantee that the Services and the Platform will be available without interruption and without errors. <br>We are not liable, though, if for any reason, negligence included, despite the maintained security measures adopted by us, the operation of the Platform is interrupted or access to the Platform or the User Profiles becomes difficult and / or impossible or if viruses or other harmful software is identified and transmitted to the terminals of the users / visitors, or if third unauthorized parties intervene in any way to the Content and operation of the Platform making the use of it difficult or causing problems to its proper function. <br>Moreover, we are not liable if the Platform is not accessible for reasons beyond our control as well as for reasons due to technical or other failure of the backbone network or for reasons of force majeure or incidental facts. In case of any loss or damage of the Content our sole liability and responsibility will be to repost the Content to the extent technically feasible from our periodic back-ups.
                           </h4><br><h4>
                           6.5 We reserve the right: <br>(a) to change at any time, without justification and without prior notice, partially or in total, the Terms & Conditions, the features and services provided, the Platform’s functionalities as well as the Platform’s versions or the provided Content and features, <br>(b) to renew or upgrade or discontinue / stop, partially or in total, all of the Content of the Platform and/or any User Account, <br>(c) to renew or upgrade partially or in total the external appearance (interface), the structure or composition (configuration) of the Platform and/or any User Account as well as their technical specifications, <br>(d) to limit the access of the entire Platform to any registered or unregistered User. Moreover, we reserves the right at any time, to cancel, suspend or pause or shut down its operation.
                           </h4><br><h4>
                           6.6 Furthermore, Platform reserves the right to suspend and/or delete a User Account and/or refuse the opening of a User Account, at any time, for any reason, including in the event we become aware of a repeatedly infringing use of the Platform from any User and/or any Platform visitor and/or any third party, or in case we receive takedown notices regarding a User’s repeatedly infringing behavior.
                           </h4><br><h4>
                           6.7 TO THE FULLEST EXTENT PROVIDED BY LAW, IN NO EVENT WILL COMPANY, ITS AFFILIATES OR THEIR LICENSORS, SERVICE PROVIDERS, EMPLOYEES, AGENTS, OFFICERS OR DIRECTORS BE LIABLE FOR DAMAGES OF ANY KIND, UNDER ANY LEGAL THEORY, ARISING OUT OF OR IN CONNECTION WITH YOUR USE, OR INABILITY TO USE, THE PLATFORM OR ANY CONTENT ON THE PLATFORM INCLUDING ANY DIRECT, INDIRECT, SPECIAL, INCIDENTAL, CONSEQUENTIAL OR PUNITIVE DAMAGES, INCLUDING BUT NOT LIMITED TO, PERSONAL INJURY, PAIN AND SUFFERING, EMOTIONAL DISTRESS, LOSS OF REVENUE, LOSS OF PROFITS, LOSS OF BUSINESS OR ANTICIPATED SAVINGS, LOSS OF USE, LOSS OF GOODWILL, LOSS OF DATA, AND WHETHER CAUSED BY TORT (INCLUDING NEGLIGENCE), BREACH OF CONTRACT OR OTHERWISE, EVEN IF FORESEEABLE. THE FOREGOING DOES NOT AFFECT ANY LIABILITY WHICH CANNOT BE EXCLUDED OR LIMITED UNDER APPLICABLE LAW.
                           </h4><br><h4>
                           In no event shall the platform, its officers, directors, employees, or agents, be liable to Users for any direct, indirect, incidental, special, punitive, or consequential damages whatsoever. This limitation on liability includes, but is not limited to, <br>(i) personal injury or property damage, of any nature whatsoever, resulting from the Users’ use of the Platform, <br>(ii) any loss or damage due to unauthorized access to or use of our servers and/or any and all business information stored therein, <br>(iii) any loss or damage due to interruption or cessation of transmission to or from our Platform or interoperability problems, <br>(iv) any loss or damage due to bugs, viruses, trojan horses, or the like, which may be transmitted to or through our website by any third party, <br>(v) any errors or omissions in any Content, <br>(vi) any defamatory, offensive, or illegal conduct of any third party, <br>(vii) any statement or conduct of any third party on the Platform <br>(viii) any loss or damage resulting from the use, or inability to use, any portion of our website or the Platform or for any loss or damage of any kind in the User data, or <br>(ix) any loss of revenue, profits, goodwill or any special, indirect, consequential or pure economic loss, costs, damages, charges or expenses. <br>In any case whatsoever to the extent permitted by applicable law, liability of the Platform is limited to the amount paid by such User in the prior six months. <br>The limitations on liability apply whether liability is based on warranty, contract, tort, or any other legal theory, and whether or not the platform is advised of the possibility of such damages.
                           </h4><br>
                       <h3>7. Notice and Take Down Process—Report to Competent Authorities</h3>
                       <h4>
                           7.1 The Platform reserves and has the right to suspend temporarily or permanently delete, any User Account and Profile or User Generated Content any time at its sole discretion, including when it becomes aware of any breach of law or the present Terms & Conditions by any User or by any third party.
                           </h4><br><h4>
                           7.2 More specifically, the Platform reserves the right to remove from the Platform any allegedly infringing Content following the submission of a takedown notice. Anyone who wants to send to the Platform a claim asking to take down any Content (notice and take down process), as provisioned in the law, should take every reasonable measure to ensure that the grounds for this claim are adequate and concern specific Content uploaded or posted by a specific registered User. Notice and take down notices submitted to the Platform must be clear and explicit, specifically indicating the (allegedly) infringing Content to be taken down. The claimant should provide to us adequate data to be able to identify the potential unlawful act or omission, as well as to avoid unjustified, unsubstantiated, untrue and unfair disclosures.
                           </h4><br><h4>
                           7.3 The Platform will respond to notices of alleged copyright infringement that comply with applicable law. If any person believes that any materials accessible on or from the Platform infringes that person’s copyright, that person may request removal of those materials (or access to them) from the Platform by submitting Copyright Infringement Liability Limitation Act of the Digital Millennium Copyright Act (17 U.S.C. § 512) (“DMCA”), the written notice (the “DMCA Notice”) must include substantially the following:
                           </h4><br><h4>
                           7.3.1 Include the complaining party’s contact information. The information must be reasonably sufficient for the Platform to contact the complaining party.
                           </h4><br><h4>
                           7.3.2 Identify the copyrighted or otherwise protected work or works claimed to be infringed.
                           </h4><br><h4>
                           7.3.3 Identify (a) for material stored by the Platform, the allegedly infringing and/or unlawful material, or (b) for information location tools, the reference or link to the allegedly infringing material or activity. This information must be sufficient to allow the Company to locate the material, reference, or link.
                           </h4><br><h4>
                           7.3.4 Include a physical or electronic signature of a person authorized to act on the rightsholder’s behalf.
                           </h4><br><h4>
                           7.3.5 Include a statement that the complaining party has a good faith belief that the infringing material is not authorized by the copyright owner, the copyright owner’s agent, or law.
                           </h4><br><h4>
                           7.3.6 Include a statement that the information in the notice is accurate and, under penalty of perjury, that the complaining party is authorized to act on behalf of the rightsholder.
                           A takedown notice that does not substantially comply with the above requirements generally does not require the Platform to take down the allegedly infringing material.
                           </h4><br><h4>
                           7.4 Counter-notice: Further to the submission of a takedown notice as per the above, the alleged infringer may submit a counter-notice, which must substantially include:
                           </h4><br><h4>
                           7.4.1 The counter-claimant’s name, address, telephone number, and physical or electronic signature.
                           </h4><br><h4>
                           7.4.2 Identification of the material that was taken down.
                           </h4><br><h4>
                           7.4.3 The counter-claimant’s statement, under penalty of perjury, of its good faith belief that the material was taken down due to a mistake or misidentification.
                           </h4><br><h4>
                           7.5 For the purposes of the notice & takedown process described above, the Platform has designated, an agent for the receipt of notifications of claimed infringements, support.
                           </h4><br><h4>
                           7.6 If any damage occurs to the Platform because of the Platform’s actions further to a notice submitted by a claimant, that claimant assumes all responsibility for covering the damage and any related expenses of the Company. We shall disregard any claim that does not fulfill the above prerequisites. Any claimant and/or counter-claimant that knowingly makes a material misrepresentation that Content is infringing and, following such misrepresentation, the platform takes down any Content, shall be fully liable towards the platform for any damage caused as a result to such misrepresentations.
                           </h4><br><h4>
                           7.7 In any case and notwithstanding the above, if any breach of the present Terms & Conditions comes to the attention of the Platform (following any automated control or complaint as per the above) may at its discretion (depending to the severity of each case) (a) give notice to the User and request to refrain from any such violation, and/or (b) block a User from the Platform (temporarily or permanently) and withdraw the relevant credentials, and/or (c) delete the User Account (see also article 9 below).
                           </h4><br><h4>
                           7.8 Notwithstanding the above, we shall proceed to suspension or termination of any Content further to a Court or a Competent Authority order.
                           </h4><br><h4>
                           7.9 The platform shall in no manner be liable towards the Users and/or any third party for taking down Content, pursuant to the above process, and each User acknowledges that the platform is in no position and has no obligation to examine the accuracy of any notice and take down request and/or counter-notice submitted by any User, Client and/or any third party.
                           </h4><br><h4>
                           7.10 Report to the competent Authorities: The Platform further reserves its right to report any breach coming to its attention to the relevant law enforcement authorities under the conditions laid down in the applicable laws of the country. Also, the platform could provide any information requested by any competent authority (including personal or business data) with regard to the Users and the User Account in the Platform, with or without prior notice to such Users, subject to the applicable laws of the country.
                           </h4><br>
                           <h3>8. Intellectual Property</h3>
                         <h4>
                           8.1 Platform Intellectual Property rights<br>
                           8.1.1 Except as otherwise indicated for User Generated Content in the present terms, the Platform and all text, images, marks, logos and other Content contained herein, including, without limitation, the logo and all designs, text, graphics, pictures, information, data, software, sound files, other files, and the selection and arrangement thereof are the proprietary property of {{ env('APP_NAME') }}or its licensors and are protected by applicable intellectual property laws. You may not modify, reproduce or publicly display, perform, or distribute or otherwise use any such information or materials for any public or commercial purpose except in accordance with the terms of the COMPANY Platform. A User may not copy, reproduce, publish, transmit, distribute, perform, display, post, modify, create derivative works from, sell, license, or otherwise exploit the Platform or any materials on the Site, except as expressly permitted by these T&Cs or other applicable policies. You must not delete or alter any copyright, trademark or other proprietary rights notices from copies of materials.
                           </h4><br><h4>
                           8.1.2 The platform logo and name and all other product or service names or slogans of {{ env('APP_NAME') }}displayed on the Platform are trademarks of {{ env('APP_NAME') }}and may not be copied, imitated or used, in whole or in part, without the prior written permission of {{ env('APP_NAME') }}. In addition, the look and feel of the Platform may not be copied, imitated or used, in whole or in part, without the prior written permission of eLearning Industry. All other trademarks, including registered trademarks, product names and company names or logos mentioned in the Platform are the property of their respective owners. Reference to any products, services, processes or other information, by trade name, trademark, manufacturer, supplier or otherwise does not constitute or imply endorsement, sponsorship or recommendation thereof by {{ env('APP_NAME') }}.
                           </h4><br><h4>
                           8.1.3 As soon as anyone becomes a User, the Platform provides him/her with a personal, non-transferable, non-exploitable, non-exclusive, open-ended one user license to access the Content hosted in the Platform only for legitimate private use purposes under the present terms and conditions. It is expressly forbidden to use the Content for illegal purposes and/or for professional exploitation. Users may not sublicense the use of, or the access to the Platform and the services to any third party with or without remuneration. The present license shall be automatically terminated when the relationship with the Platform is terminated for any reason, as provisioned in article 9.
                           </h4><br><h4>
                           8.1.4 Providing access and allowing the use of the features, tools and Services provided by the Platform does not give any User or any other third-party ownership of any of the Company’s intellectual property rights to any of the above. We retain ownership of all intellectual property rights in and to the Platform, its features, tools and Services including copies, improvements, enhancements, derivative works and modifications thereof. The rights to use the Platform are limited to those expressly granted hereby. No other rights with respect to the Platform or any related intellectual property rights are granted or implied.
                           </h4><br><h4>
                           8.2 Intellectual property rights on the Content uploaded by registered Users
                           </h4><br><h4>
                           8.2.1 By submitting Content to upload in the Platform each User provides to the Platform the license referred to in article 5.2.2.b) above. {{ env('APP_NAME') }}shall not accept previously published articles from registered Users, if this is indicated in the specific guidelines posted in the Platform at the point of submission. Authors or submitters of articles are not entitled to compensation and shall not be paid for any access or use of the Articles from the Platform. After an Article is uploaded to the Platform, the Registered User submitting such Article may be featured as an {{ env('APP_NAME') }}contributor/blogger. Features articles are selected based on the Registered User’s seniority.
                           </h4><br><h4>
                           8.2.2 The Platform is not liable for any access or use of any User Generated Content, including any that is uploaded by Registered Users in violation of any User’s and/or any other third party’s intellectual property rights. Platform bears no liability for any dispute that may arise between the Users, registered Users and Clients and/or between the Users, registered Users and Clients on the one hand and any third party on the other, regarding intellectual property rights in relation to the Content uploaded by the registered Users on the Platform. The provisions and warranties provided by the Registered User in article 5 apply in such case as well.
                           </h4><br><h4>
                           8.2.3 All Users browsing and having access to Content in the Platform are expressly prohibited to engage in any unlawful act which may undermine the rights of the registered Users-owners or right holders of the Content uploaded at the Platform. Indicatively, but not exclusively, Users are prohibited from engaging into any unlawful act or omission, including (but not limited to) the following activities:
                               <br>
                           .	Recording and direct or indirect, temporary or permanent reproduction of the Content by any means and in any form, in whole or in part, except as expressly allowed within the Platform.<br>
                           .	Translation of the Content.<br>
                           .	Arrangement, adaptation or other alteration of the Content.<br>
                           .	Unauthorized and/or illegal distribution to the public in any form by sale or otherwise.<br>
                           .	Renting and public lending of the original or copies of their work.<br>
                           .	Public performance of the Content.<br>
                           .	Transmission or retransmission of the Content to the public by radio and television, by electromagnetic waves or cables or pipes or other material in any other way, parallel to the surface of the earth or through satellites.<br>
                           .	Any other act or action contrary to these Terms & Conditions.
                           </h4><br>
                       <h3>9. Termination</h3>
                       <h4>
                           9.1 A Registered User may at any time decide to delete such User’s User Account and Profile by e-mailing us at support with a request to delete the User Account and Profile. In this case article 3.8 shall apply. Register Users who wish to delete their User Account and Profile and terminate their relationship with the Platform, will no longer be able to make use of the services provided in the Platform for Registered Users (as per article 2.2).
                           </h4><br><h4>
                           9.2 The Platform may terminate a User’s access to all or any part of the Platform and/or his/her User Account at any time, without cause, with or without a prior notice.
                           </h4><br><h4>
                           9.3 The Platform reserves without limitation the right to suspend and/or delete any User Account and terminate the Platform’s relationship with any registered User for due cause, including (indicatively but not exclusively) the following:
                           </h4><br><h4>
                           9.3.1 any violation of the present terms and conditions or any other illegal act or omission violating any laws or statutory provisions;
                           </h4><br><h4>
                           9.3.2 provision of false/inaccurate information in the User Account;
                           </h4><br><h4>
                           9.3.3 violation of any right of a third person that has come to our attention;
                           </h4><br><h4>
                           9.3.4 following a complaint received by another User or by a third parties for breach of the present terms, violation of any law or statute;
                           </h4><br><h4>
                           9.3.5 following the request of any Authority and/or Court decision and/or relevant competent Body;
                           </h4><br><h4>
                           9.3.6 any other or omission that could damage or harm in any ways the Platform (i.e. indicatively its operation, its reputation, its tradename and IPRs, its technical specifications, its software etc.);
                           </h4><br><h4>
                           9.3.7 repeatedly infringing and unlawful conduct on behalf of any User;
                           </h4><br><h4>
                           9.3.8 as a result of the notice and take down process described in article 7 above.
                           </h4><br><h4>
                           9.3.9 In any case whatsoever the provisions of article 3.9 above apply also respectively.
                           </p><br>
                           <h3>10. Confidentiality</h3>
                           <h4>
                           As a result of the provision of the Platform services to Users, and whether due to any intentional or negligent act or omission, we may disclose to Users or they may otherwise learn of or discover, our non-public documents, business practices, object code, source code, management styles, day-to-day business operations, capabilities, systems, current and future strategies, marketing information, financial information, software, technologies, processes, procedures, methods and applications, or other aspects of our business (“Confidential Information”). Users hereby agree and acknowledge that such information is confidential and shall be our sole and exclusive intellectual property and proprietary information. Users agree to use our Confidential Information only for the specific purposes as allowed in these Terms. Any disclosure of our Confidential Information to a third party specifically including a direct competitor is strictly prohibited and will be vigorously challenged in a court of law. All obligations contained herein shall survive the termination of these Terms. Furthermore, Users acknowledge that our information is proprietary, confidential and extremely valuable to us, and that we would be materially damaged by any disclosure of our Confidential Information. Users acknowledge and agree that monetary damages provide an insufficient remedy for the breach of this confidentiality obligation, and that we shall be entitled to injunctive relief.
                           </h4>
                           <br>
                           <h3>11. Indemnification</h3>
                           <h4>
                           In addition to any other warranty, indemnification and declaration of Users, all Users also agree to indemnify and hold harmless {{ env('APP_NAME') }}, its contractors, and its licensors, and their respective directors, officers, employees and agents from and against any and all claims and expenses including attorneys’ fees, arising out of their use of the Platform, including but not limited to the violation of the Terms & Conditions.
                           </h4>
                           <br>
                           <h3>12. Applicable Law and Jurisdiction</h3>
                           <h4>
                           These terms are considered as terms between business (B2B) and are governed by and construed according to the laws of the country. Both parties agree that they are subject to the exclusive jurisdiction of the courts of the city of Reno in Nevada.
                           At our sole discretion, we may require you to submit any disputes arising from the use of the Platform or any violation of these T&C’s, including disputes arising from or concerning their interpretation, violation, invalidity, non-performance, or termination, to final and binding arbitration under the Rules of Arbitration of the American Arbitration Association applying country law.
                           </h4>
                           <br>
                           <h3>13. Miscellaneous</h3>
                           <h4>
                           13.1 Above Terms and Conditions and the Privacy Policy shall bind all parties and constitute the entire agreement of the parties and prevail in any and all prior and existing contracts between the User and {{ env('APP_NAME') }}.
                           </h4><br><h4>
                           13.2 If individual terms of the Terms & Conditions become partially or wholly invalid or unenforceable, the validity of the remaining provisions shall not be affected.
                           </h4><br><h4>
                           13.3 The Company’s failure to enforce any right or provisions of the present Terms & Conditions will not constitute a waiver of such or any other provision.
                           </h4><br><h4>
                           13.4 Users may not assign any of their rights under the present Terms & Conditions to any third party. {{ env('APP_NAME') }}reserves the right to assign its rights under the present to any other individual or entity at its sole discretion.
                           </h4><br><h4>
                           13.5 {{ env('APP_NAME') }}reserves the right, at its own discretion to modify or replace any part of these Terms. It is the Users’ responsibility to check the Terms & Conditions periodically for changes. The Users’ continued use of or access to the Platform following the posting of any changes to the Terms & Conditions constitutes acceptance of those changes. {{ env('APP_NAME') }}may also, in the future offer new services and/or features through the Platform. Such new features and/or services shall be subject to the Terms & Conditions.</h4>

                       </h4>
                   </div>
               </div>
           </div>
       </div>
   </section>


@include('include.footer')
        
   
@include('include.e_script')