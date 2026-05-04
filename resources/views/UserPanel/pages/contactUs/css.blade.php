<style>
    input {
        border-radius: 5px;
        border: 1px solid #ccc;
        padding: 4px;
    }

    label span {
        font-size: 1rem;
    }

    label.error {
        color: red;
        font-size: 1rem;
        display: block;
        margin-top: 5px;
    }

    input.error {
        border: 1px dashed red;
        font-weight: 300;
        color: red;
    }

    .contactWrap{
        padding-top: 80px;
        padding-bottom: 80px;
    }
    .contactLeft{}
    .contactLeft h2 {
        font-weight: 600;
        font-size: 36px;
        line-height: 45px;
        color: #000000;
    }
    .contactLeft p {
        font-weight: 300;
        font-size: 16px;
        line-height: 22px;
        color: #000000;
        padding-right: 100px;
    }
    .contactLeft img{
         margin-top: 50px;
    }
    .contactRightWrap {
        border: 1px solid #D0D5DD;
        box-sizing: border-box;
        border-radius: 15px;
        box-shadow: 0px 20px 30px rgba(0, 0, 0, 0.09);
        padding: 30px;
    }
    .contactRightWrap h2 {
        font-weight: 500;
        font-size: 24px;
        line-height: 36px;
        color: #000;
    }
    .contactRightWrap .form-control {
        border: 1px solid #D0D5DD;
        box-sizing: border-box;
        box-shadow: 0px 1px 2px rgba(16, 24, 40, 0.05);
        border-radius: 8px;
        margin-bottom: 10px;
        color: #667085;
    }
    .contactRightWrap label {
        font-weight: 500;
        font-size: 14px;
        line-height: 20px;
        color: #344054;
        margin-bottom: 5px;
    }
    .contactRightWrap .btn-primary {
        background: #458DFC;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.15);
        border-radius: 15px;
        color: #FFFFFF;
        font-weight: 600;
        font-size: 20px;
        line-height: 40px;
        width: 100%;
        border: 0px;
        height: 50px;
    }
    .contactRightWrap .form-select{
        border: 1px solid #D0D5DD;
        box-sizing: border-box;
        box-shadow: 0px 1px 2px rgba(16, 24, 40, 0.05);
        border-radius: 8px;
        margin-bottom: 10px;
        color: #667085;
    }
    input.error {
        border: 1px dashed red !important;
        font-weight: 300;
        color: red !important;
    }
    label.error {
        font-size: 1rem;
        display: block;
        margin-top: 0px;
        color: #ec7171 !important;
    }



    .selectBox {
        border: 1px solid #D0D5DD;
        box-sizing: border-box;
        box-shadow: 0px 1px 2px rgba(16, 24, 40, 0.05);
        border-radius: 8px;
        margin-bottom: 10px;
        color: #667085;
        position: relative;
        cursor: pointer;
        padding: .375rem 2.25rem .375rem .75rem;
        -moz-padding-start: calc(0.75rem - 3px);
        font-size: 1rem;
    }
    .selectBox__value {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        display: block;
    }
    .selectBox:after {
        position: absolute;
        right: 12px;
        top: 50%;
        transform: translateY(-50%) rotate(0deg);
        transition: all 0.2s ease-in-out;
        content: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='14.001' height='8.165' viewBox='0 0 14.001 8.165'%3E%3Cdefs%3E%3Cstyle%3E.a%7Bfill:%23212121;%7D%3C/style%3E%3C/defs%3E%3Cpath class='a' d='M13.861,60.224l-.7-.7a.441.441,0,0,0-.645,0L7,65.036,1.487,59.522a.441.441,0,0,0-.645,0l-.7.7a.441.441,0,0,0,0,.645l6.537,6.538a.441.441,0,0,0,.645,0l6.538-6.538a.442.442,0,0,0,0-.645Z' transform='translate(0 -59.382)'/%3E%3C/svg%3E");
    }
    .selectBox .dropdown-menu {
        transition: all 0.5s ease-in-out;
        opacity: 0;
        display: block;
        top: 100%;
        width: 100%;
        max-height: 250px;
        z-index: -1;
        overflow-y: auto;
        transform: translateY(-15%);
        visibility: hidden;
    }
    .selectBox.show {
        background-color: #fff;
    }
    .selectBox.show:after {
        transform: translateY(-50%) rotate(180deg);
    }
    .selectBox.show .dropdown-menu {
        transition: all 0.3s ease-in-out;
        visibility: visible;
        opacity: 1;
        z-index: 1;
        transform: translateY(0);
        padding: 0;
        left: 0;
        box-shadow: 0px 12px 16px -4px rgba(16, 24, 40, 0.1), 0px 4px 6px -2px rgba(16, 24, 40, 0.05);
        border-radius: 8px;
    }
    .dropdown-item:focus, .dropdown-item:hover {
        color: #101828;
        background-color: #ECF4FF;
    }
    .dropdown-item.active, .dropdown-item:active {
        color: #101828;
        text-decoration: none;
        background-color: #ecf4ff;
    }
    .dropdown-item{
        position: relative;
        padding: .50rem 1rem;
    }
    .icon-tick {
        position: absolute;
        right: 20px;
        top: 15px;
        visibility: hidden;
    }
    .active .icon-tick{
        visibility: visible;
    }
    .fc-mail {
        padding-left: 35px;
    }
    .mail-icon{
        position: absolute;
        top: 37px;
        left: 20px;
    }
    #subject-error{
    padding-top: 9px;
    }
    .disabled{
        cursor: not-allowed;
    }
    .select2-container--default .select2-selection--single {
        background-color: #fff;
        border: 1px solid #aaa;
        border-radius: 4px;
        border: 1px solid #D0D5DD;
        box-sizing: border-box;
        box-shadow: 0px 1px 2px rgba(16, 24, 40, 0.05);
        border-radius: 8px;
        margin-bottom: 10px;
        color: #667085;
        height: 38px;
    }
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        color: #667085;
        line-height: 37px;
        height: 38px;
    }
    .select2-container--default .select2-results__option--highlighted.select2-results__option--selectable {
        background-color: #5897fb;
        color: #101828;
        background: #ECF4FF;
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow b {
       display:none
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 26px;
        position: absolute;
        top: 1px;
        right: 10px;
        width: 20px;
    }
    .select2-dropdown {
        background-color: white;
        border: 1px solid #eee;
        border-radius: 4px;
        box-sizing: border-box;
        display: block;
        position: absolute;
        left: -100000px;
        width: 100%;
        z-index: 1051;
        background: #FFFFFF;
        box-shadow: 0px 12px 16px -4px rgba(16, 24, 40, 0.1), 0px 4px 6px -2px rgba(16, 24, 40, 0.05);
        border-radius: 8px;
    }
    .select2-container {
        box-sizing: border-box;
        display: inline-block;
        margin: 0;
        position: relative;
        vertical-align: middle;
        width: 100% !important;
    }
    .select2-container--default .select2-results__option--selected {
        background-color: #ecf4ff;
    }
    .select2-selection__arrow::before {
        border-style: solid;
        border-width: 2px 2px 0 0;
        content: '';
        display: inline-block;
        height: 10px;
        left: 0.15em;
        position: relative;
        top: 10px;
        transform: rotate(135deg);
        vertical-align: top;
        width: 11px;
        border-color: #667085;
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
