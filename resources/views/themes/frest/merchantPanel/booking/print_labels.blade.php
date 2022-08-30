<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Invoice Print</title>
    <style>
        html,
        body,
        div,
        span,
        applet,
        object,
        iframe,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        p,
        blockquote,
        pre,
        a,
        abbr,
        acronym,
        address,
        big,
        cite,
        code,
        del,
        dfn,
        em,
        img,
        ins,
        kbd,
        q,
        s,
        samp,
        small,
        strike,
        strong,
        sub,
        sup,
        tt,
        var,
        b,
        u,
        i,
        center,
        dl,
        dt,
        dd,
        ol,
        ul,
        li,
        fieldset,
        form,
        label,
        legend,
        table,
        caption,
        tbody,
        tfoot,
        thead,
        tr,
        th,
        td,
        article,
        aside,
        canvas,
        details,
        embed,
        figure,
        figcaption,
        footer,
        header,
        hgroup,
        menu,
        nav,
        output,
        ruby,
        section,
        summary,
        time,
        mark,
        audio,
        video {
            margin: 0;
            padding: 0;
            border: 0;
            font-size: 100%;
            font: inherit;
            vertical-align: baseline;
        }

        /* HTML5 display-role reset for older browsers */
        article,
        aside,
        details,
        figcaption,
        figure,
        footer,
        header,
        hgroup,
        menu,
        nav,
        section {
            display: block;
        }

        body {
            line-height: 1;
        }

        ol,
        ul {
            list-style: none;
        }

        blockquote,
        q {
            quotes: none;
        }

        blockquote:before,
        blockquote:after,
        q:before,
        q:after {
            content: "";
            content: none;
        }

        table {
            border-collapse: collapse;
            border-spacing: 0;
        }
    </style>
</head>

<body style="padding: 10px">

    <p style="visibility: hidden;"></p>
    <div style="  background-color: white;  box-sizing: border-box; border: 1px solid #787878; margin-bottom: 25px; ">
        <!-- merchant section -->
        <header style="  padding: 15px; border-bottom: 1px solid #787878; ">
            <div style="float: left; width: 15%">
                <p style="font-size:14px; font-weight: semi-bold;">MERCHANT: </p>
            </div>
            <div style="float: left; padding-left: 0px; width: 80%;">
                <p style="margin-bottom: 5px; font-weight: bold; font-size:18px;">
                    {{ $parcel->merchant->name }}
                </p>
                <p style="margin-bottom: 5px;">
                    {{ $parcel->pickup_address->address }}
                </p>
                <p>{{ $parcel->merchant->phone }}</p>
            </div>
            <div style="clear: both;"></div>
        </header>
        <!-- customer section -->
        <section style="padding: 15px; border-bottom: 1px solid #787878; ">
            <div style="float: left; width: 15%">
                <p style="font-size:14px; font-weight: semi-bold;">CUSTOMER: </p>
            </div>
            <style>
                .customer {
                    display: flex;
                    flex-direction: column;
                    justify-content: space-between;
                }

                .customer .name {
                    justify-content: center;
                    font-weight: 500
                }

                .customer .paid {
                    float: right;
                    font-weight: 600
                }
            </style>


            <div style="float: left; padding-left: 0px; width: 83%;">
                <div class="customer">
                    <div class="name">
                        {{ $parcel->customer_name }}

                    </div>
                    <div class="paid">TK. {{ $parcel->collection_amount }}</div>
                </div>


                <p style="margin-bottom: 5px;">
                    {{ $parcel->delivery_address }}
                </p>
                <p style="font-weight: bold;"> {{ $parcel->customer_phone }}</p>
            </div>
            <div style="clear: both;"></div>
        </section>
        <!-- invoice section -->
        <section style=" border-bottom: 1px solid #787878;">
            <div style="float: left; padding: 15px; width: 30%;">
                <p>
                    <span style="font-weight: bold; padding-right: 5px;">INVOICE#: </span>
                    <span>{{ $parcel->merchant_order_id }}</span>
                </p>
            </div>
            <div style="float: left; padding: 15px; width: 30%; border-left: 1px solid #787878;">
                <p>
                    <span style="font-weight: bold; padding-right: 5px;">AREA: </span>
                    <span>{{ $parcel->area->name }}</span>
                </p>
            </div>
            <div style="float: left; padding: 15px; width: 20%; border-left: 1px solid #787878;">
                <p>
                    <span style="font-weight: bold; padding-right: 5px;">HUB: </span>
                    <span>{{ $parcel->branchs->name }}</span>
                </p>
            </div>

            <div style="clear: both;"></div>
        </section>
        <!-- instruction section -->
        {{-- <section style="padding: 15px; border-bottom: 1px solid #787878;">
            <p></p>
        </section> --}}
        @php
            use Milon\Barcode\DNS1D;
            use Milon\Barcode\DNS2D;
            $s = new DNS2D();
        @endphp

        <!-- barcode and qr section  -->
        <style>
            .barcode {
                padding: 15px;
                height: 170px;



            }

            .qrcode {
                width: auto;
                height: 161px;
                display: inline-block;
                vertical-align: middle;
                padding: 12px;
                border-right: 1px solid #787878;
            }

            .barcode-box {
                float: left;
                /* border-bottom: 1px solid #787878; */
                padding-left: 20px;
                /* width: 78%; */
                /* text-align: center; */
                /* vertical-align: middle; */
            }
        </style>

        <section class="barcode">

            <div style="float:left; width: 22%;">
                <img class="qrcode"
                    src="data:image/gif;base64,{{ $s->getBarcodePNG($parcel->parcel_id, 'QRCODE', 50, 50, [0, 0, 0], true) }}"
                    alt="{{ $parcel->parcel_id }}">

            </div>
            <div style="float:right;width: 75%;">
                <div class="barcode-box">
                    <img style=" width: 100%; height: 70px;display: inline-block; vertical-align: middle; padding: 10px 0 10px 80px;"
                        src="data:image/png;base64,{{ DNS1D::getBarcodePNG($parcel->parcel_id, 'C128', 1, 40, [0, 0, 0], true) }}"
                        alt="barcode" />
                </div>

                <div style="width: 100%; margin-top:100px; border-top:1px solid black;">
                    <div style="width: 45%; float: left; padding: 27px 0; text-align:center;">
                        <p style="padding: 0px;">
                            <span style="font-weight: bold;">PARCEL ID: </span>
                            <span>{{ $parcel->parcel_id }}</span>
                        </p>
                    </div>
                    <div
                        style="width: 50%; float: right; padding: 27px 0; border-left: 1px solid #787878; text-align:center;">
                        <p style="padding: 0px;">
                            <span style="font-weight: bold;">PARCEL CREATED: </span>
                            <span>{{ $parcel->created_at->format('Y-m-d H:m A') }}</span>
                        </p>
                    </div>
                    <div style="clear: both;"></div>
                </div>


            </div>

        </section>

    </div>
</body>

</html>
