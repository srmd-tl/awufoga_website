@extends('layouts.report')
@section('content')
<div class="container" >
  @includeWhen(request()->pdf==true,'reports.pdfViews.include.header',['date'=>\Carbon\Carbon::now()->toDateString(),'name'=>'Blogs Report','logo'=>asset('logo.png')])   
    <style>
    th ,td{
     text-align: left;
     font-size: 14px;
    }
  </style>             
  <table  style="
    table-layout: fixed;
    margin: 30px auto !important; width: 100%;border-collapse: collapse;">
    

   <thead class="thead-light"  style="background: #e8e8e8;">
       <tr>
          <th >Title</th>
          <th >Category </th>
          <th >Share</th>
          <th >Read</th>
       </tr>
    </thead>
    <tbody>
       @forelse($blogs as $blog)
       <tr>
          <td  class="viewBlog" data-image="{{$blog->blog_image}}" >{{$blog->title}}</td>
          <td   >{{$blog->category->name}}</td>
          <td  >{{$blog->share_num}}</td>
          <td  >{{$blog->read_num}}</td>

<!--           <td>

             <span class="badge badge-{{$blog->status==1?'success':'danger'}}">{{$blog->status==1?'Active':'Inactive'}}</span>

          </td -->
       </tr>
       @empty
       <tr>
          <td>Nothing Found!</td>
       </tr>
       @endforelse
    </tbody>
    </table>
      @includeWhen(request()->pdf==true,'reports.pdfViews.include.footer',['name'=>'Blogs Report','page'=>$blogs->currentPage()])
  </div>
@endsection