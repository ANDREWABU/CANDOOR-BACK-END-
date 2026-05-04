<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap');

    body{
        font-family: 'Inter', sans-serif;
        margin: 0px;
    }
    .sectionOne{
        padding-top: 100px;
        padding-bottom: 100px;
    }
    .sectionOneLeft{}
    .sectionOneLeft h5 {
        font-weight: 600;
        font-size: 44px;
        line-height: 50px;
        color: #000000;
        margin-bottom: 20px;
    }
    .sectionOneLeft p {
        font-weight: 300;
        font-size: 20px;
        line-height: 32px;
        color: #475467;
    }
    .sectionOneLeft .signUpEarlyBtn {
        background: #458DFC;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.15);
        border-radius: 55px;
        font-weight: 600;
        font-size: 18px;
        line-height: 28px;
        color: #fff;
        text-decoration: none;
        padding: 15px 25px;
        margin-top: 10px;
        display: inline-block;
    }
    .sectionOneLeft strong {
        font-weight: 600;
    }
    .sectionOneRight{
        align-self: center;
    }
    .sectionOneRight img{
        width: 100%;
    }
    .companies {
        padding-bottom: 15px;
        padding-top: 10px;
    }
    .companies .col{
        max-width: 11.11%;
    }
    .sectionInside--{}
    .sectionInside-- h5{
        font-weight: 600;
        font-size: 36px;
        line-height: 56px;
        color: #000000;
        position: relative;
        margin-bottom: 40px;
    }
    .sectionInside-- h5::after {
        display: inline-block;
        content: "";
        border-top: 4px solid black;
        width: 55px;
        position: absolute;
        left: 48%;
        bottom: -20px;
    }
    .sectionInside-- p{
        font-weight: 300;
        font-size: 18px;
        line-height: 30px;
        text-align: center;
        color: #475467;
        margin-bottom: 20px;
    }
    .companies img{

    }
    .sectionInside{
        padding-bottom: 100px;
    }
    .box- {
        border: 1px solid #DAE8FE;
        box-sizing: border-box;
        box-shadow: 4px 4px 20px #E5E9F6;
        border-radius: 20px;
        padding-top: 30px;
        padding-bottom: 30px;
        margin-bottom: 20px;
        margin-top: 10px;
    }
    .stepWrap h6 {
        color: #000000;
        font-weight: 600;
        font-size: 16px;
        line-height: 24px;
    }
    .itWorksWrap{
        background: #F9FAFB;
        padding-top: 80px;
        padding-bottom: 80px;
    }
    .worksWrap{}
    .worksWrap .col-md-3{
        text-align: center;
    }
    .worksWrap .col-md-3 img {
        width: 150px;
        margin-bottom: 30px;
        margin-top: 10px;
    }
    .worksWrap .col-md-3 h6 {
        font-weight: 600;
        font-size: 18px;
        line-height: 28px;
        text-align: center;
        color: #000;
    }
    .networkWrapInner{
        margin-bottom: 50px !important;
    }
    .networkWrapInner .col-md-6{
        align-self: center;
    }
    .networkWrapInner h6{
        font-weight: 500;
        font-size: 24px;
        line-height: 32px;
        color: #000000;
    }
    .networkWrapInner p{
        font-weight: 300;
        font-size: 18px;
        line-height: 30px;
        color: #667085;
    }
    .networkWrap{
        padding-top: 80px;
        padding-bottom: 30px;
    }
    .FAQWrap{
        padding-top: 80px;
        padding-bottom: 80px;
    }
    .accordion-button:focus {
        box-shadow: none;
    }
    .accordion-item {
        background-color: #fff;
        border: 1px solid #D0D5DD;
        margin-bottom: 10px;
        border-radius: 10px !important;
    }
    .accordion-item:first-of-type .accordion-button {
        border-radius: 10px;
    }
    .accordion-button{
        border-radius: 10px;
        color: #1F305D;
        font-weight: 500;
        font-size: 20px;
    }
    .accordion-item:not(:first-of-type) {
        border-top: 0;
        border: 1px solid #D0D5DD;
    }
    .accordion-item:last-of-type .accordion-button.collapsed {
        border-radius: 10px;
    }
    .accordion-body p{
        color: #000;
        font-weight: 300;
        font-size: 14px;
        line-height: 22px;
    }
    .accordion-button:not(.collapsed) {
        color: #1F305D;
        background-color: #fff;
        box-shadow: none;
    }
    .accordion-body {
        padding-top: 0px;
    }
    .accordion-body ul{
        padding-left: 20px;
    }
    .accordion-body ul li{
        color: #000;
        font-weight: 300;
        font-size: 14px;
        line-height: 22px;
    }
    .testimonialsWrap{
        background: linear-gradient(253.57deg, #67C3F3 18.55%, #458DFC 84.98%);
        padding-top: 80px !important;
        padding-bottom: 80px !important;
    }

    .sectionInside--white h5 {
        font-weight: 600;
        font-size: 36px;
        line-height: 56px;
        color: #fff;
        position: relative;
        margin-bottom: 40px;
    }
    .sectionInside--white h5::after {
        display: inline-block;
        content: "";
        border-top: 4px solid #fff;
        width: 55px;
        position: absolute;
        left: 48%;
        bottom: -20px;
    }
    .advisorWrap{
        background-color: #fff;
        box-shadow: 0px 20px 30px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
    }
    .owl-carousel.owl-drag .owl-item {
        -ms-touch-action: pan-y;
        touch-action: pan-y;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        background-color: #fff;
        box-shadow: 0px 20px 30px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
    }

    .advisorWrap{
        padding: 15px 0px;
    }
    .advisorWrap h6{
        font-weight: 500;
        font-size: 22px;
        line-height: 48px;

        /* or 218% */

        color: #000000;
    }
    .advisorWrap p {
        color: #101828;
        font-weight: 300;
        font-size: 16px;
        line-height: 30px;
        min-height: 210px;
        margin-bottom: 0px;
    }
    .advisorWrap img{
        margin-top: 15px;
    }
    .owl-theme .owl-dots .owl-dot span {
        background: #1F3F65;
        opacity: 0.3;
    }
    .owl-theme .owl-dots .owl-dot.active span, .owl-theme .owl-dots .owl-dot:hover span {
        background: #1F3F65 !important;
        opacity:1;
    }
    .left--{
        background-image: url("images/UserImages/Home/left.png");
        width: 50px;
        height: 32px;
        background-position: center;
        background-size: 70%;
        background-repeat: no-repeat;
    }
    .right--{
        background-image: url("images/UserImages/Home/right.png");
        width: 50px;
        height: 32px;
        background-position: center;
        background-size: 70%;
        background-repeat: no-repeat;
    }
    .owl-prev{
        position: absolute;
        left: 34%;
        bottom: -5px;
    }
    .owl-next{
        position: absolute;
        right: 34%;
        bottom: -5px;
    }
    .owl-theme .owl-nav {
        margin-top: 50px;
    }
    .networkWrapInner .networkWrapInnerRight {
        align-self: center;
        text-align: center;
    }
    @media only screen and (min-width: 1600px) {
        .testimonialsWrap--{
            max-width: 1360px;
            margin: 0 auto;
        }
    }

    @media only screen and (max-width: 768px) {
        .networkWrapInnerRight{
            order: 12;
        }
        .sectionOne {
            padding-top: 20px;
            padding-bottom: 50px;
        }
        .sectionOneLeft h5 {
            font-weight: 600;
            font-size: 28px;
            line-height: 36px;
            color: #000000;
            margin-bottom: 10px;
        }
        .sectionOneLeft p {
            font-weight: 300;
            font-size: 14px;
            line-height: 24px;
            color: #475467;
        }
        .sectionOneLeft {
            margin-bottom: 50px;
        }
        .sectionOneLeft .signUpEarlyBtn {
            font-size: 14px;
            line-height: 20px;
            margin-top: 0px;
            display: inline-block;
        }
        .sectionInside-- h5 {
            font-weight: 600;
            font-size: 20px;
            line-height: 26px;
            color: #000000;
            position: relative;
            margin-bottom: 40px;
        }
        .sectionInside-- h5::after {
            border-top: 2px solid black;
            width: 55px;
            position: absolute;
            left: 42%;
            bottom: -10px;
        }
        .sectionInside-- p {
            font-size: 14px;
            line-height: 20px;
        }
        .companies .col {
            max-width: 33.33%;
            flex: 1 0 33.33%;
        }
        .companies img {
            width: 100%;
        }
        .sectionInside {
            padding-bottom: 30px;
        }
        .stepWrap .row{
            width: 140px;
        }
        .box- {
            margin-bottom: 10px;
        }
        .stepWrap .col-md-2{
            width: 50%;
        }
        .stepWrap h6 {
            font-size: 14px;
            line-height: 20px;
        }
        .networkWrap {
            padding-top: 20px;
            padding-bottom: 0px;
        }
        .networkWrapInner h6 {
            font-size: 18px;
            line-height: 24px;
        }
        .networkWrapInner p {
            font-size: 14px;
            line-height: 22px;
        }
        .networkWrapInnerRight img{
            width: 100%;
        }
        .itWorksWrap {
            background: #F9FAFB;
            padding-top: 30px;
            padding-bottom: 30px;
        }
        .worksWrap .col-md-3 img {
            width: 100px;
            margin-bottom: 30px;
            margin-top: 10px;
        }
        .sectionInside--white h5 {
            font-weight: 600;
            font-size: 18px;
            line-height: 24px;
            color: #fff;
            position: relative;
            margin-bottom: 40px;
        }
        .sectionInside--white h5::after {
            display: inline-block;
            content: "";
            border-top: 3px solid #fff;
            width: 55px;
            position: absolute;
            left: 44%;
            bottom: -15px;
        }
        .owl-carousel .owl-item img {
            display: block;
            width: 100px;
            margin: 0 auto;
        }
        .advisorWrap {
            padding: 15px 0px;
            text-align: center;
        }
        .advisorWrap p {
            color: #101828;
            font-weight: 300;
            font-size: 14px;
            line-height: 22px;
            min-height: 210px;
            margin-bottom: 0px;
        }
        .owl-prev {
            bottom: -45px;
        }
        .owl-next {
            bottom: -45px;
        }
        .accordion-button {
            border-radius: 10px;
            color: #1F305D;
            font-weight: 500;
            font-size: 14px;
        }
        .accordion-body ul li {
            color: #000;
            font-weight: 300;
            font-size: 14px;
            line-height: 24px;
            margin-bottom: 10px;
        }
        .footerWrap {
            padding: 20px;
        }
        .footer-widget-1 p {
            font-size: 14px;
            line-height: 24px;
            color: #FFFFFF;
            margin-top: 20px;
        }
        .footer-widget-2 .text-end {
            text-align: left !important;
        }
        .footer-widget-2 ul {
            padding: 0px;
        }
        .contactWrap {
            padding-top: 20px;
            padding-bottom: 20px;
        }
        .contactLeft h2 {
            font-weight: 600;
            font-size: 26px;
            line-height: 30px;
            color: #000000;
        }
        .contactLeft p {
            font-weight: 300;
            font-size: 14px;
            line-height: 22px;
            color: #000000;
            padding-right: 0px;
        }
        .contactLeft img {
            margin-top: 50px;
            margin-bottom: 50px;
            width: 100%;
        }
        .contactRightWrap {
            padding: 10px 0px;
        }
        .contactRight{
            padding: 0px;
        }
        body {
            overflow-x: hidden;
        }

        .sectionInside--white p {
            font-weight: 300;
            font-size: 14px;
            line-height: 24px;
            text-align: center;
            color: #fff;
            margin-bottom: 20px;
        }
        .aboutWrapText p {
            color: #FFFFFF;
            font-weight: 400;
            font-size: 14px;
            line-height: 24px;
        }
        .aboutWrap {
            background: #295597;
            padding-top: 20px;
            padding-bottom: 20px;
        }
        .meetTeam {
            padding-top: 30px;
            padding-bottom: 30px;
        }
        .meetTeam .col-md-3 {
            width: 50%;
            padding: 3px;
        }
        .testimonial .card {
            margin-bottom: 10px;
        }
        .testimonial .card h6 {
            font-weight: 600;
            font-size: 13px;
            line-height: 20px;
            margin-bottom: 5px;
            margin-top: 10px;
        }
        .testimonial .card p {
            font-size: 12px;
            line-height: 18px;
            letter-spacing: -0.015em;
            color: #000000;
            margin-bottom: 0px;
        }
        .testimonial-text p {
            font-size: 14px;
            line-height: 24px;
            font-weight: 300;
            color: #101828;
        }
        .valuesWrap .col-md-4 {
            text-align: center;
            margin-bottom: 10px;
            width: 50%;
        }
        .valuesWrap .col-md-4 h6 {
            font-weight: 500;
            font-size: 16px;
            line-height: 22px;
            text-align: center;
            color: #101828;
        }
        .aboutStoryWrap {
            padding-top: 30px;
            padding-bottom: 30px;
            background: #F2F4F7;
        }
        .aboutStoryWrap p {
            font-weight: 300;
            font-size: 14px;
            line-height: 24px;
            color: #101828;
            padding: 0;
        }
        .footer-widget-2 ul li {
            display: inline-block;
            padding-left: 0px;
            padding-right: 20px;
        }
    }


</style>
