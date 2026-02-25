@extends('layouts.layout')
@section('pageTitle')
     {{env('Page_Title')}}
@endsection

@section('pageHead')
    <div id="page-head">
	@php $appinfo=DB::table('tblcompanyinfo')->first(); @endphp
        <div class="pad-all text-center">
            <h3>{{$appinfo->company_name?? ''}}</h3>
            <p><h4>{{$appinfo->solution?? 'MBR Finance Management System'}}</h4></p>
        </div>
    </div>
@endsection
@section('content')

    <!--- content comes here -->



    <!--/// content end here -->

@endsection


@section('scripts')

        
   <script src="{{asset('assets/js/jquery-ui.min.js')}}"></script>
<script src="{{asset('assets/js/Chart.min.js')}}"></script>
<script src="{{asset('assets/js/jquery.easypiechart.min.js')}}"></script>

<script src="{{asset('assets/js/king-chart-stat.js')}}"></script>

   
	

@endsection

@section('styles')
<style>
.table-responsives
{
min-height: .01%;
}
/*------------------------------------------------*/
/*	Chart
/*------------------------------------------------*/
/* easy pie chart */
.easy-pie-chart {
  position: relative;
  width: 110px;
  margin: 0 auto;
  margin-bottom: 15px;
  text-align: center; }
  .easy-pie-chart canvas {
    position: absolute;
    top: 0;
    left: 0; }
  .easy-pie-chart .percent {
    display: inline-block;
    vertical-align: middle;
    *vertical-align: auto;
    *zoom: 1;
    *display: inline;
    line-height: 110px;
    z-index: 2; }
    .easy-pie-chart .percent:after {
      content: '%';
      margin-left: 0.1em;
      font-size: .8em; }
  .easy-pie-chart#cpu-usage {
    width: 130px; }
    .easy-pie-chart#cpu-usage .percent {
      line-height: 128px; }

/* chart navigation */
.chart-nav {
  margin-bottom: 40px; }
  @media screen and (max-width: 480px) {
    .chart-nav strong {
      display: block; } }
  .chart-nav ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    display: inline;
    border-bottom: none;
    margin-bottom: 30px; }
    .chart-nav ul li {
      margin: 0;
      padding: 0;
      display: inline; }
      .chart-nav ul li a {
        font-size: 0.9em;
        border: none;
        padding: 5px 8px;
        color: #555; }
        .chart-nav ul li a:hover, .chart-nav ul li a a:focus {
          border: none;
          text-decoration: none;
          background-color: #ececec;
          border-bottom: 1px solid #E1E1E1;
          text-decoration: none; }
      .chart-nav ul li.active a, .chart-nav ul li.active a:hover, .chart-nav ul li.active a:focus {
        background-color: #ececec;
        border-bottom: 1px solid #E1E1E1;
        text-decoration: none; }

.chart-content {
  margin-bottom: 15px; }

#line-chart1 {
  height: 250px; }

/* flot chart */
.flot-tooltip {
  border: 1px solid #ccc;
  background-color: rgba(255, 255, 255, 0.7);
  color: #aaa; }

#flotTip, .jqstooltip {
  -webkit-border-radius: 0 !important;
  -moz-border-radius: 0 !important;
  border-radius: 0 !important;
  background-color: #f3f3f3 !important;
  color: #555 !important;
  border-color: silver !important; }

.sales-chart,
.demo-flot-chart {
  width: 100%;
  height: 350px; }

#visit-chart {
  height: 300px; }

#investment-donut-chart {
  height: 300px; }

.widget.real-time-chart .widget-content {
  padding-right: 40px; }
.widget.real-time-chart #demo-real-time-chart {
  font-size: 12px;
  padding-right: 40px; }
  @media screen and (max-width: 768px) {
    .widget.real-time-chart #demo-real-time-chart .flot-x-axis .flot-tick-label {
      display: none; } }

.donut-label {
  font-size: 12px;
  color: #FFF;
  background: rgba(0, 0, 0, 0.5);
  text-align: center;
  padding: 3px; }

.secondary-stat {
  padding: 20px 0; }
  .secondary-stat .secondary-stat-item {
    color: #506167;
    padding: 5px 20px 0 20px; }
    .secondary-stat .secondary-stat-item .data {
      float: left;
      margin-bottom: 0; }
    .secondary-stat .secondary-stat-item .inlinesparkline {
      display: inline-block;
      vertical-align: middle;
      *vertical-align: auto;
      *zoom: 1;
      *display: inline;
      position: absolute;
      left: 15px;
      bottom: 0; }

.color:nth-child(1) {
    color: green;
}
.color:nth-child(2) {
    color: red;
}
.border
{
	border-bottom: 1px solid #ddd;
}
element
{
width:320px;
height:320px;
}
</style>
@endsection