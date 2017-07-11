<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <title>Lyon-Informe</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<body style="margin: 0; padding: 0; font-family: Raleway,sans-serif;color: #636b6f">



<table align="center" border="0" cellpadding="0" cellspacing="0" width="800" style="border-collapse: collapse;">
    <tr>
        <td>
            <table border="0">
                <tr>
                    <td>
                        <img src="{{url('img/lyon_email.jpg')}}">
                    </td>
                </tr>
            </table>

        </td>
    </tr>
    <tr>
        <td>
            <table border="0" cellpadding="10" cellspacing="10" style="padding-bottom: 100px">
                <tr>
                    <td>
                        <b>{{$title}}</b>
                    </td>
                </tr>
                <tr>
                    <td>
                        {!!  $body  !!}
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td width="75%" bgcolor="#D2B48C" style="padding: 30px 30px 30px 30px" >
            &reg; Lyon Engenharia {{\Carbon\Carbon::now()->year}}<br/>
            Tecnologia da Informação | {{ env('MAIL_DEFAULT_TI', 'informe@lyonengenharia.com') }} - (31)2125-6639
        </td>
    </tr>
</table>
</body>