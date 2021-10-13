{{--<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">--}}
{{--<html xmlns="http://www.w3.org/1999/xhtml">--}}
<html>
<head>

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>

<body>
<table id="background-table" border="0" cellpadding="0" cellspacing="0" width="100%">
    <tbody>
    <tr>
        <td align="center">
            <table class="w640" border="0" cellpadding="0" cellspacing="0" width="640">
                <tbody>
                <tr class="large_only">
                    <td class="w640" height="20" width="640"></td>
                </tr>
                <tr class="mobile_only">
                    <td class="w640" height="10" width="640"></td>
                </tr>
                <tr class="mobile_only">
                    <td class="w640" height="10" width="640"></td>
                </tr>
                <tr class="mobile_only">
                    <td class="w640" align="center" width="640">
                        <table class="w640" border="0" cellpadding="0" cellspacing="0" width="640">
                            <tr class="mobile_only">
                                <td class="w40" width="40"></td>
                                <td class="w560" width="560" valign="top" align="center">
                                    <img class="mobile_only mobile-logo" border="0" src="{{ asset('assets/home/images/logo@2x.png') }}" />
                                </td>
                                <td class="w40" width="40"></td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr class="large_only">
                    <td class="w640"  height="20" width="640"></td>
                </tr>
                <tr>
                    <td class="w640" width="640" colspan="3" height="20"></td>
                </tr>
                <tr>
                    <td id="header" class="w640" align="center" width="640">
                        <table class="w640" border="0" cellpadding="0" cellspacing="0" width="640">
                            <tr>
                                <td class="w30" width="30"></td>
                                <td id="logo" valign="top" align="center">
                                    <img border="0" src="{{ asset('assets/home/images/logo@2x.png') }}" />
                                </td>
                                <td class="w30" width="30"></td>
                            </tr>
                            <tr>
                                <td colspan="3" height="20" class="large_only"></td>
                            </tr>
                            <tr>
                                <td colspan="3" height="20" class="large_only"></td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td class="w640" bgcolor="#ffffff" width="640">
                        <table class="w640" border="0" cellpadding="0" cellspacing="0" width="640">
                            <tbody>
                                <!-- Body content -->
                                <tr>
                                    <td class="content-cell">
                                        {{ Illuminate\Mail\Markdown::parse($slot) }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td class="w640" bgcolor="#ffffff" width="640" colspan="3" height="20"></td>
                </tr>
                <tr>
                    <td class="w640" bgcolor="#ffffff" width="640" colspan="3" height="20"></td>
                </tr>
                <tr>
                    <td>
                        <table width="640" class="w640" align="center" cellpadding="0" cellspacing="0">
                            <tr>
                                <td class="w50" width="50"></td>
                                <td class="w410" width="410">
                                    @include('vendor.mail.sunny.contentStart')
                                        {{ $subcopy ?? '' }}
                                        <p class="text-muted">Email di generate otomatis oleh sistem, Mohon untuk tidak membalas email ini.</p>
                                    @include('vendor.mail.sunny.contentEnd')
                                </td>
                                <td valign="top">
                                    <table align="right">
                                        <tr>
                                            <td colspan="2" height="10"></td>
                                        </tr>
                                        <tr>
{{--                                            @if (isset($twitter))--}}
                                                <td><a href="https://twitter.com/edopranata"><img src="{{ Request::getSchemeAndHttpHost() }}/vendor/beautymail/assets/images/ark/twitter.png" alt="Twitter" height="25" width="25" style="border:0" /></a></td>
{{--                                            @endif--}}

{{--                                            @if (isset($facebook))--}}
                                                <td><a href="https://facebook.com/edopranata"><img src="{{ Request::getSchemeAndHttpHost() }}/vendor/beautymail/assets/images/ark/fb.png" alt="Facebook" height="25" width="25" style="border:0" /></a></td>
{{--                                            @endif--}}
                                        </tr>
                                    </table>
                                </td>
                                <td class="w15" width="15"></td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td class="w640" width="640" colspan="3" height="20"></td>
                </tr>
                <tr>
                    <td id="footer" class="w640" height="60" width="640" align="center">
                        {{ $footer ?? '' }}
                    </td>
                </tr>
                <tr>
                    <td class="w640" width="640" colspan="3" height="40"></td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    </tbody>
</table>
</body>
</html>

{{--<table class="wrapper" width="100%" cellpadding="0" cellspacing="0" role="presentation">--}}
{{--    <tr>--}}
{{--        <td align="center">--}}
{{--            <table class="content" width="100%" cellpadding="0" cellspacing="0" role="presentation">--}}
{{--            {{ $header ?? '' }}--}}
{{--                <!-- Email Body -->--}}
{{--                <tr>--}}
{{--                    <td class="body" width="100%" cellpadding="0" cellspacing="0">--}}
{{--                        <table class="inner-body" align="center" width="640" cellpadding="0" cellspacing="0" role="presentation">--}}
{{--                            <!-- Body content -->--}}
{{--                            <tr>--}}
{{--                                <td class="content-cell">--}}
{{--                                    {{ Illuminate\Mail\Markdown::parse($slot) }}--}}

{{--                                    {{ $subcopy ?? '' }}--}}
{{--                                </td>--}}
{{--                            </tr>--}}
{{--                        </table>--}}
{{--                    </td>--}}
{{--                </tr>--}}
{{--                {{ $footer ?? '' }}--}}
{{--            </table>--}}
{{--        </td>--}}
{{--    </tr>--}}
{{--</table>--}}
