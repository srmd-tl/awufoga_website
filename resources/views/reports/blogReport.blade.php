@extends('layouts.app')
@section('content')

@include('layouts.headers.cards')
<div class="container-fluid mt--7">
   @include('alerts.alert')
   <div class="row">
      <div class="col">
         <div class="card shadow">
            <div class="card-header border-0">
               <div class="row align-items-center">
                  <div class="col-12">
                     <div class="categories-detail">
                        <h3 class="mb-0">Blogs</h3>
                        <div class="btn_style1">
                           <a href="" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-form">Add Blog</a>
                           <a href="{{route('blog.index')}}" class="btn btn-sm btn-primary">Clear Search</a>
                        </div>
                     </div>
                  </div>
                   <div class="col-12">
                     <div class="Search_item">
                          <!-- <form method="GET" action="{{route('vendor.index')}}" class="mr-2">
                           <div class="form-group">
                                 <button value="1" class="btn btn-sm btn-primary" name="statusFilter">Active Search</button>
                                 <button value="0" class="btn btn-sm btn-primary" name="statusFilter">Inactive Search</button>
                           </div>
                           </form> -->
                        <form action="{{route('blog.index')}}">
                           <div class="select_option">
                              <select name="statusFilter">
                                 <option {{request()->statusFilter=='1'?'selected':''}} value="1">Active</option>
                                 <option {{request()->statusFilter=='0'?'selected':''}} value="0">Inactive</option>
                              </select>
                           </div>
                           <div class="form-group">
                               <div class="input-group">
                                 <div class="input-group-prepend">
                                   <span class="input-group-text"><i class="ni ni-zoom-split-in"></i></span>
                                 </div>

                                <!--  @if(isset(request()->statusFilter))
                                 <input type="hidden" name="statusFilter" value="{{request()->statusFilter}}">
                                 @endif -->
                                 <input  class="form-control" placeholder="Search" type="text" name="filter" value="{{request()->filter}}">


                               </div>
                               <button class="btn btn-sm btn-primary" >Search</button>
                           </div>
                        </form>

                     </div>

                  </div>
               </div>
            </div>
            <div class="col-12">
            </div>

                       <div class="leader-box">
               <div class="row">
                  <div class="col-md-12">
                     <div class="title-leader">
                        <h3>Buy leader board</h3>
                     </div>
                  </div>
               </div>
               <div class="row">
                <div class="col-12">
                  <form action="">
                     <div class="row">
                        <div class="col-md-4">
                           <div class="buyer-leader-box">
                              <label for="">From Date</label>
                              <input type="text" id="datepicker" value="{{\Carbon\Carbon::now()->toDateString()}}">
                           </div>
                        </div>
                        <div class="col-md-4">
                           <div class="buyer-leader-box">
                              <label for="">To Date</label>
                              <input type="text" value="{{\Carbon\Carbon::now()->toDateString()}}">
                           </div>
                        </div>
                        <div class="col-md-4">
                           <div class="buyer-leader-box">
                              <label for="">Category</label>
                              <select name="" id="">
                                 <option value="">All</option>
                                 <option value="">Category 1</option>
                                 <option value="">Category 2</option>
                                 <option value="">Category 3</option>
                                 <option value="">Category 4</option>
                              </select>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-4">
                           <div class="buyer-leader-box">
                              <label for="">Sub Category</label>
                              <select name="" id="">
                                 <option value="">All</option>
                                 <option value="">Category 1</option>
                                 <option value="">Category 2</option>
                                 <option value="">Category 3</option>
                                 <option value="">Category 4</option>
                              </select>
                           </div>
                        </div>
                        <div class="col-md-4">
                           <div class="buyer-leader-box">
                              <label for="">Active Buyer</label>
                              <select name="" id="">
                                 <option value="">All</option>
                                 <option value="">Category 1</option>
                                 <option value="">Category 2</option>
                                 <option value="">Category 3</option>
                                 <option value="">Category 4</option>
                              </select>
                           </div>
                        </div>
                        <div class="col-md-4">
                           <div class="buyer-leader-box">
                              <label for="">Order By</label>
                              <select name="" id="">
                                 <option value="">Most Purchasing Buyers</option>
                                 <option value="">Category 1</option>
                                 <option value="">Category 2</option>
                                 <option value="">Category 3</option>
                                 <option value="">Category 4</option>
                              </select>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-4">
                           <div class="buyer-leader-box">
                              <label for="">City</label>
                              <select name="" id="">
                                 <option value="">Most Purchasing Buyers</option>
                                 <option value="">Category 1</option>
                                 <option value="">Category 2</option>
                                 <option value="">Category 3</option>
                                 <option value="">Category 4</option>
                              </select>
                           </div>
                        </div>
                        <div class="col-md-4">
                           <div class="buyer-leader-box">
                              <label for="">Coupon Type</label>
                              <select name="" id="">
                                 <option value="">Most Purchasing Buyers</option>
                                 <option value="">Category 1</option>
                                 <option value="">Category 2</option>
                                 <option value="">Category 3</option>
                                 <option value="">Category 4</option>
                              </select>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-12">
                           <div class="leader-btn">
                              <a href="" class="search-btn">Search</a>
                              <a href="" class="clear-btn">Clear</a>
                              <a href="{{ request()->fullUrlWithQuery(['pdf' => 'true']) }}" class="export-btn">Export To PDF</a>
                              <a href="{{ request()->fullUrlWithQuery(['excel' => 'true']) }}" class="export-btn">Export To Excel</a>
                           </div>
                        </div>
                     </div>
                  </form>
                </div>
            </div>
            <div class="table_design">
            <div class="table-responsive">
               <table class="table align-items-center table-flush">
                  <thead class="thead-light">
                     <tr>
                        <th scope="col">Title</th>
                        <th scope="col">Category </th>
                        <th scope="col">Share</th>
                        <th scope="col">Read</th>
                        <th scope="col"></th>
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
                  <tfoot>
                     <tr>
                        <td>{{$blogs->withQueryString()->links()}}</td>
                     </tr>
                  </tfoot>
               </table>
            </div>
            </div>
            </div>
            <div class="card-footer py-4">
               <nav class="d-flex justify-content-end" aria-label="...">
               </nav>
            </div>
         </div>
      </div>
   </div>


     <!-- View Subcat Modal -->
     <div class="col-md-4">
      <div class="modal fade" id="view-blog-form" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
         <div class="modal-dialog modal- modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
               <div class="modal-body p-0">
                  <div class="card bg-secondary border-0 mb-0">
                     <div class="card-body px-lg-5 py-lg-5">
                        <div class="text-center text-muted mb-4">
                           <small>View  Image</small>
                        </div>
                        <form role="form">

                            <div class="form-group mb-3">
                              <div class="input-group input-group-merge input-group-alternative">
                                 <img src="" id="viewImage">
                              </div>
                            </div>

                           <div class="text-center">
                              <button type="button" class="btn btn-success my-4" data-dismiss="modal">Close </button>
                           </div>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- End View SUb cat Modal -->
@include('layouts.footers.auth')
</div>

@push('js')
<script type="text/javascript">
    $(function(){
      
          $(".viewBlog").click(function(){
            var description = "{{asset('storage')}}/"+$(this).data('description')
            $("#viewImage").attr('src',description)
            $("#view-blog-form").modal()

        })
      
    })
</script>
@endpush
@endsection
