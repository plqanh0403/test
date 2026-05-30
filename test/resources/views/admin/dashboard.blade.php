@extends('admin.layout.layoutAdmin1') {{-- kế thừa layout --}}

@section('content') {{-- đổ content vào layout --}}
    <div class="dashboard-cards">

    <div class="stat-card purple">
        <h6>Total Users</h6>
        <h2>125</h2>
    </div>

    <div class="stat-card pink">
        <h6>Total Blogs</h6>
        <h2>86</h2>
    </div>

    <div class="stat-card orange">
        <h6>Contacts</h6>
        <h2>54</h2>
    </div>

    <div class="stat-card blue">
        <h6>Services</h6>
        <h2>18</h2>
    </div>

</div>
@endsection

{{-- @yield: nơi layout hiển thị nội dung --}}