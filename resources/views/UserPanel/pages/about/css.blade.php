<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap');

    body{
        font-family: 'Inter', sans-serif;
        margin: 0px;
    }
    .aboutStoryWrap{
        padding-top: 80px;
        padding-bottom: 80px;
        background: #F2F4F7;
        margin-top: 50px;
    }
    .according-to-linkedIn-a{
        color: #f1f4f8;
    }
    .according-to-linkedIn-a:hover{
        color: #c1dbfd;
    }
    .sectionInside-- h5 {
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
    .sectionInside--white p {
        font-weight: 300;
        font-size: 36px;
        line-height: 54px;
        text-align: center;
        color: #fff;
        margin-bottom: 20px;
    }

    .aboutStoryWrap p{
        font-weight: 300;
        font-size: 18px;
        line-height: 30px;
        color: #101828;
    }
    .sectionInside-- p {
        font-weight: 300;
        font-size: 18px;
        line-height: 30px;
        text-align: center;
        color: #101828;
        margin-bottom: 20px;
    }
    .valuesWrap{}
    .valuesWrap .col-md-4{
        text-align: center;
        margin-bottom: 30px;
    }
    .valuesWrap .col-md-4 img{
        margin-bottom: 10px;
        margin-top: 10px;
    }
    .valuesWrap .col-md-4 h6{
        font-weight: 500;
        font-size: 20px;
        line-height: 30px;
        text-align: center;
        color: #101828;
    }
    .valuesWrap{}
    .aboutWrap{
        background: #295597;
        padding-top: 80px;
        padding-bottom: 80px;
    }
    .aboutWrapText p{
        color: #FFFFFF;
        font-weight: 300;
        font-size: 18px;
        line-height: 30px;
    }
    .meetTeam{
        padding-top: 80px;
        padding-bottom: 80px;
    }
    .headerWrap{
        background: #295597;
        border-bottom: 1px solid #458DFC;
    }
    .whiteBg-icon{
        display: none;
    }
    .blueBg-logo{
        display: block !important;
    }
    .Ba-btn{
        display: none;
    }
    .Ba-btn2 {
        background: #458DFC;
        border: 2px solid #458DFC;
        box-sizing: border-box;
        border-radius: 10px;
        color: #fff !important;
        font-weight: 500;
        padding-left: 15px !important;
        padding-right: 15px !important;
        display: block !important;
    }
    .Ba-btn2 img{
        margin-left: 5px;
    }
    .testimonial-text{
        display: none;
    }
    .testimonial-text.active{
        display: block;
    }
    .testimonial-text p{
        font-size: 18px;
        line-height: 30px;
        font-weight: 300;
        color: #101828;
    }
    .testimonial-text p strong{
        font-weight: 600;
    }
    .testimonial .card{
        background: #FFFFFF;
        box-shadow: 0px 5px 30px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
        padding: 0px;
        border: 0;
        margin-bottom: 30px;
    }
    .testimonial .card .card-body{
        cursor: pointer;
    }
    .testimonial .card h6 {
        font-weight: 600;
        font-size: 18px;
        line-height: 24px;
        margin-bottom: 0px;
        margin-top: 10px;
        color: #000000;
    }
    .testimonial .card p {
        font-size: 18px;
        line-height: 22px;
        letter-spacing: -0.015em;
        color: #000000;
        margin-bottom: 0px;
    }
    .owner-img{
        width:100%
    }

    .team-img{
        width:100%;
        margin-bottom: 15px;
        border-radius: 1.5%;
    }

    .testimonial .card:hover{
        background: linear-gradient(210.35deg, #67C3F3 7.98%, #458DFC 89.67%);
        box-shadow: 0px 5px 30px rgba(0, 0, 0, 0.1);
    }
    .testimonial.active .card{
        background: linear-gradient(210.35deg, #67C3F3 7.98%, #458DFC 89.67%);
        box-shadow: 0px 5px 30px rgba(0, 0, 0, 0.1);
    }
    .arrow-icon{
        position: absolute;
        bottom: 0;
        right: 10px;
    }
    .arrow-icon2 {
        position: absolute;
        bottom: 0;
        right: 10px;
    }
    .testimonial .card:hover .arrow-icon {
        z-index: 99;
    }
    .testimonial .card:hover h6{
        color: #fff;
    } .testimonial .card:hover p{
        color: #fff;
    }
    .testimonial .card:hover .arrow-icon2 {
        display: none;
    }
    .testimonial.active .card h6{
      color: #fff;
    }
    .testimonial.active .card p{
        color: #fff;
    }
    .testimonial.active .arrow-icon2{
        display: none;
    }
    @media only screen and (min-width: 1600px) {
      .width-team{
          max-width: 1140px;
      }
    }
    @media only screen and (max-width: 768px) {
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
            margin-top: 40px;

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
        #navbarNav{
            z-index: 99;
            padding: 0px;
        }
        #navbarNav ul{
            background: #474748;
            padding: 10px;
            border-radius: 5px;
        }
    }

</style>
