@extends('layouts.themes') @section('content') @include("../themes.th3.includes.breadcrumb")
<!--************************breadcrumb********************-->
@php
        $pageurl = clean_single_input(request()->segment(2));
        $langid1 = session()->get('locale')??1;
@endphp 
<!--**********************************mid part******************-->
<section>
    <div class="container">
        <div class="row">
          
        <div class="col-xs-12 col-sm-12">
<div class="content-div">
<h2>Screen Reader Access</h2>
<table  class="table table-bordered table-striped mt-3 mb-5" title="Screen Reader Access">
  <tbody><tr>
    <th>Screen Reader</th>
    <th>Website</th>
    <th>Free/Commercial</th>
  </tr>
 
  <tr class="odd">
    <td style="vertical-align:top;">Non Visual Desktop Access (NVDA)</td>
    <td style="vertical-align:top;"><a href="http://www.nvda-project.org/" target="_blank" onClick="return sitevisit()">http://www.nvda-project.org&nbsp;</a></td>
    <td style="vertical-align:top;">Free</td>
  </tr>
  <tr class="even">
    <td style="vertical-align:top;">System Access To Go</td>
    <td style="vertical-align:top;"><a href="http://www.satogo.com/" target="_blank" onClick="return sitevisit()">http://www.satogo.com&nbsp;</a></td>
    <td style="vertical-align:top;">Free</td>
  </tr>
  <tr class="odd">
    <td style="vertical-align:top;">Thunder</td>
    <td style="vertical-align:top;"><a href="http://www.webbie.org.uk/thunder/" target="_blank" onClick="return sitevisit()">http://www.webbie.org.uk/thunder/</a></td>
    <td style="vertical-align:top;">Free</td>
  </tr>
  <tr class="odd">
    <td style="vertical-align:top;">JAWS</td>
    <td style="vertical-align:top;"><a href="https://support.freedomscientific.com/Downloads/JAWS" target="_blank" onClick="return sitevisit()">https://support.freedomscientific.com/Downloads/JAWS</a></td>
    <td style="vertical-align:top;">Commercial</td>
  </tr>
  <tr class="odd">
    <td style="vertical-align:top;">Screen Access For All (SAFA)</td>
    <td style="vertical-align:top;"><a href="http://www.nabdelhi.in/it-services/technology-training-center/downloads/" target="_blank" onClick="return sitevisit()">http://www.nabdelhi.in/it-services/technology-training-center/downloads/</a></td>
    <td style="vertical-align:top;">Free</td>
  </tr>
   <tr class="odd">
    <td style="vertical-align:top;">Supernova</td>
    <td style="vertical-align:top;"><a href="http://www.yourdolphin.co.uk/productdetail.asp?id=1" target="_blank" onClick="return sitevisit()">http://www.yourdolphin.co.uk/productdetail.asp?id=1</a></td>
    <td style="vertical-align:top;">Commercial</td>
  </tr>
</tbody></table>
</div>
</div>


        </div>
    </div>
</section>

@endsection
