l-invoice.blade.php
<!-- Emails use the XHTML Strict doctype -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <!-- The character set should be utf-8 -->
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width"/>
    </head>

    <body>
        <div style="width:767px; margin:0 auto;">
            <div style="width:667px; margin:0 auto; padding-top:20px; font-family: Proxima Nova Rg; padding-bottom:20px;">

                <div style="clear:both; padding-bottom:40px;"></div>
                </section>
                <div style="float:left; width:33.3%; font-size:14px;">
                    Date Issued: <strong>{{date('jS F Y')}}</strong><br/>
                    Invoice No: <strong>{{$data['order_id']}}</strong>
                </div>
                <div style="float:left; width:33.3%;"></div>
                <div style="float:right; width:33.3%; text-align:right;">
                    <span style="font-size:24px;">{{$data['name']}}</span><br/>
                    {{$data['email']}}<br/>
                    {{$data['city']}}
                </div>
                </section>
                <div style="clear:both;padding-bottom:30px;padding-top:30px;"></div>
                <section style="font-size:11px;">
                    <div style="float:left; width:50%;">DESCRIPTION</div>
                    <div style="float:left; width:50%; text-align:center;">
                        <div style="float:left; width:33.3%;">RATE</div>
                        <div style="float:left; width:33.3%;">No. OF UNITS</div>
                        <div style="float:left; width:33.3%;">SUBTOTAL</div>
                    </div>
                </section>
                <hr/>
                <div style="clear:both; padding-bottom:30px;"></div>
                <section style="font-weight:bold;font-size:16px;">
                    <div style="float:left; width:50%; font-size:16px;">Standard Charge</div>
                    <div style="float:left; width:50%; text-align:center; font-size:16px;">
                        <div style="float:left; width:33.3%;">${{$data['unitPrice']}}</div>
                        <div style="float:left; width:33.3%;">{{$data['paidUnit']}}</div>
                        <div style="float:left; width:33.3%;">${{$data['subTotal']}}</div>
                    </div>
                </section>

            </div>
        </div>

    </body>
</html>
1
2
3
4
5
6
7
8
9
10
11
12
13
14
15
16
17
18
19
20
21
22
23
24
25
26
27
28
29
30
31
32
33
34
35
36
37
38
39
40
41
42
43
44
45
46
47
48
49
50
51
<!-- Emails use the XHTML Strict doctype -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <!-- The character set should be utf-8 -->
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width"/>
    </head>
 
    <body>
        <div style="width:767px; margin:0 auto;">
            <div style="width:667px; margin:0 auto; padding-top:20px; font-family: Proxima Nova Rg; padding-bottom:20px;">
 
                <div style="clear:both; padding-bottom:40px;"></div>
                </section>
                <div style="float:left; width:33.3%; font-size:14px;">
                    Date Issued: <strong>{{date('jS F Y')}}</strong><br/>
                    Invoice No: <strong>{{$data['order_id']}}</strong>
                </div>
                <div style="float:left; width:33.3%;"></div>
                <div style="float:right; width:33.3%; text-align:right;">
                    <span style="font-size:24px;">{{$data['name']}}</span><br/>
                    {{$data['email']}}<br/>
                    {{$data['city']}}
                </div>
                </section>
                <div style="clear:both;padding-bottom:30px;padding-top:30px;"></div>
                <section style="font-size:11px;">
                    <div style="float:left; width:50%;">DESCRIPTION</div>
                    <div style="float:left; width:50%; text-align:center;">
                        <div style="float:left; width:33.3%;">RATE</div>
                        <div style="float:left; width:33.3%;">No. OF UNITS</div>
                        <div style="float:left; width:33.3%;">SUBTOTAL</div>
                    </div>
                </section>
                <hr/>
                <div style="clear:both; padding-bottom:30px;"></div>
                <section style="font-weight:bold;font-size:16px;">
                    <div style="float:left; width:50%; font-size:16px;">Standard Charge</div>
                    <div style="float:left; width:50%; text-align:center; font-size:16px;">
                        <div style="float:left; width:33.3%;">${{$data['unitPrice']}}</div>
                        <div style="float:left; width:33.3%;">{{$data['paidUnit']}}</div>
                        <div style="float:left; width:33.3%;">${{$data['subTotal']}}</div>
                    </div>
                </section>
 
            </div>
        </div>
 
    </body>
</html>