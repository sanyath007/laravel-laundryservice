@extends('layouts.main')

@section('content')
<div class="container-fluid">
  
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">หน้าหลัก</a></li>
    <li class="breadcrumb-item active">@{{title}}</li>
  </ol>

  <!-- page title -->
  <div class="page__title">
    <span>รายการจองใช้รถ</span>
    <a class="btn btn-primary pull-right">
      <i class="fa fa-plus" aria-hidden="true"></i>
      เพิ่มรายการ
    </a>
  </div>

  <hr />
  <!-- page title -->

  <div class="row">
    <div class="col-md-4">
      <div class="input-group col-sm-9 col-md-8">
        <input type="text" value="IV6003000001" class="form-control" aria-label="...">
        <div class="input-group-btn">
          <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            เงินสด
            <span class="caret"></span>
          </button>
          <ul class="dropdown-menu dropdown-menu-right">
            <li><a href="#">เงินเชื่อ</a></li>
          </ul>
        </div><!-- /btn-group -->
      </div><!-- /input-group -->
    </div>

    <div class="col-md-4"></div>

    <div class="col-md-4">
      <div class="form-group col-sm-9 col-md-8 pull-right">
        <input type="text" name="" value="14/03/2560" class="form-control">
      </div>
    </div>

  </div>

  <div class="row">
    <!-- left column -->
    <div class="col-md-8">

      <div class="panel panel-default">
        <div class="panel-body">

          <!-- <form class="form-horizontal" method="post"> -->

            <div class="row" style="margin-bottom: 10px;">
              <div class="col-md-12">
                <!-- <div class="form-group"> -->
                  <div class="input-group">
                    <span class="input-group-btn">
                      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#dlgProducts">
                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                      </button>
                    </span>
                    <input type="text" id="searchProduct" class="form-control" placeholder="สินค้า&hellip;"
                           ng-keyup="completeProducts(product)" ng-model="product">
                    <!-- ng-keyup="$event.keyCode == 13 && showCustomer()" -->
                  </div>

                  <!-- Autocomplete List -->
                  <div class="list-group" ng-model="hidethis" ng-hide="hidethis" style="width: auto; z-index: 10; position: absolute;">
                    <a class="list-group-item" ng-repeat="p in filterProduct" ng-click="fillProductList(p)">
                      @{{p.name}}
                    </a>
                  </div>
                  <!-- Autocomplete List -->

                  <!-- Modal -->
                  <div class="modal fade" id="dlgProducts" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                          <h4 class="modal-title" id="">เพิ่มสินค้า</h4>
                        </div>
                        <div class="modal-body">
                          <div class="form-group">
                            <label for="">ชื่อสินค้า</label>
                            <input type="text" name="" ng-model="product" class="form-control">
                          </div>
                        </div>
                        <div class="modal-footer">
                          <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
                          <button type="button" class="btn btn-primary">
                            <i class="fa fa-paper-plane" aria-hidden="true"></i> Add
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- Modal -->
                <!-- </div> -->
              </div>
            </div>

            <!-- products list -->
            <div class="row">
              <div class="col-md-12">
                <div class="table-responsive" style="height: 320px;border: 1px solid #D8D8D8;">
                  <table id="products-list" class="table table-striped">
                    <thead>
                      <tr>
                        <th style="width: 8%">#</th>
                        <th>รายการ</th>
                        <th style="width: 15%">ราคา</th>
                        <th style="width: 10%">จำนวน</th>
                        <th style="width: 15%">ส่วนลด</th>
                        <th style="width: 18%">รวมเป็นเงิน</th>
                        <th style="width: 5%">...</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr ng-repeat="p in orderList">
                        <td>@{{p.product.id}}</td>
                        <td>@{{p.product.name}}</td>
                        <td>@{{p.product.price}}</td>
                        <td>
                          <a href="#" editable-text="p.qty" onbeforesave="updateQty($data)" onhide="calculateList(p)" onshow="selectText($form)">
                            @{{p.qty}}
                          </a>
                        </td>
                        <td>
                          <a href="#" editable-text="p.disc" onbeforesave="updateDisc($data)" onhide="calculateList(p)" onshow="selectText($form)">
                            @{{p.disc}}
                          </a>
                        </td>
                        <td>@{{p.amount}}</td>
                        <td>
                          <a ng-click="removeProductList(p)" style="color: red; cursor: pointer;">
                            <i class="fa fa-times-circle" aria-hidden="true"></i>
                          </a>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <!-- products list -->

            <div class="row" style="margin-top: 10px;">
              <div class="col-md-12">
                <button type="button" class="btn btn-danger">
                  <i class="fa fa-users" aria-hidden="true"></i>
                  Cancel
                </button>
                <button type="button" class="btn btn-info">
                  <i class="fa fa-users" aria-hidden="true"></i>
                  Hold
                </button>
                <button type="button" class="btn btn-danger">
                  <i class="fa fa-undo" aria-hidden="true"></i>
                  Return
                </button>
                <button type="button" class="btn btn-warning">Void</button>
                <button type="button" class="btn btn-success">Pay (F12)</button>
              </div>
            </div>

          <!-- </form> -->

        </div>
      </div>
    </div>
    <!-- left column -->

    <!-- right column -->
    <div class="col-md-4">
      <div class="panel panel-success">
        <div class="panel-body">
          <div class="row" ng-show="!isCustomer">
            <div class="col-md-12">
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-btn">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#dlgCustomers">
                      <i class="fa fa-user-plus" aria-hidden="true"></i>
                    </button>
                  </span>
                  <input type="text" class="form-control" placeholder="ลูกค้า&hellip;"
                  ng-keyup="complete(customer)" ng-model="customer">
                  <!-- ng-keyup="$event.keyCode == 13 && showCustomer()" -->
                </div>

                <!-- Autocomplete List -->
                <div class="list-group" ng-model="hidethis" ng-hide="hidethis" style="width: auto; z-index: 10; position: absolute;">
                  <a class="list-group-item" ng-repeat="c in filterCustomer" ng-click="fillTextbox(c)">
                    @{{c.name}}
                  </a>
                </div>
                <!-- Autocomplete List -->

                <!-- Modal -->
                <div class="modal fade" id="dlgCustomers" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="">เพิ่มลูกค้า</h4>
                      </div>
                      <div class="modal-body">
                        <div class="form-group">
                          <label for="">ชื่อสินค้า</label>
                          <input type="text" name="" ng-model="product" class="form-control">
                        </div>
                      </div>
                      <div class="modal-footer">
                        <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
                        <button type="button" class="btn btn-primary">
                          <i class="fa fa-paper-plane" aria-hidden="true"></i> Add
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Modal -->
              </div>
            </div>
          </div>

          <div class="row" ng-show="isCustomer">
            <div class="col-md-8">
              <div class="testimonials">
                <div class="carousel-info">
                  <img alt="" src="http://keenthemes.com/assets/bootsnipp/img1-small.jpg" class="pull-left">
                  <div class="pull-left">
                    <span class="testimonials-name">@{{customer.name}}</span>
                    <span class="testimonials-post">Balance : </span>
                    <span class="testimonials-post">Point : </span>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-4">
              <a ng-click="removeCustomer($event)" class="pull-right" style="color: red; margin-left: 4px;">
                <i class="fa fa-times-circle" aria-hidden="true"></i>
              </a>

              <a href="#" class="pull-right" style="color: blue;">
                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
              </a>
            </div>
          </div>

        </div>
      </div><!-- /.panel -->

      <div class="panel panel-danger">
        <div class="panel-body">
          <div class="row">
            <div class="col-md-12">
              <p>
                <span>Sale Person :</span><span class="pull-right">Kobe</span>
              </p>
              <p>
                <span>Sub Total :</span><span class="pull-right">@{{subTotal}}</span>
              </p>
              <p>
                <span>Discount :</span>
                <a href="#" class=" pull-right" editable-text="discount">@{{discount}}</a>
              </p>
              <p>
                <span>Tax :</span>
                <a href="#" class=" pull-right" editable-text="tax">@{{tax}}</a>
              </p>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <h4>Total :</h4>
              <h2>@{{total}}</h2>
            </div>
            <div class="col-md-6">
              <h4>Amount Due :</h4>
              <h2>0.00</h2>
            </div>
          </div>

          <div class="row" style="margin-bottom: 5px;">
            <div class="col-md-12">
              <label for="" col-md-12>ชำระโดย :</label>
              <div data-toggle="buttons">
                <label type="button" class="btn btn-default active">
                  <input type="radio" name="q1" value="0">
                  Cash
                </label>
                <label type="button" class="btn btn-default">
                  <input type="radio" name="q1" value="0">
                  Credit Card
                </label>
                <label type="button" class="btn btn-default">
                  <input type="radio" name="q1" value="0">
                  Check
                </label>
                <label type="button" class="btn btn-default">
                  <input type="radio" name="q1" value="0">
                  Credit
                </label>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <div class="input-group">
                  <input type="text" class="form-control" placeholder="0.00" ng-model="total">
                  <span class="input-group-btn">
                    <button type="button" class="btn btn-success">
                      <i class="fa fa-cart-arrow-down" aria-hidden="true"></i>
                      จบการขาย
                    </button>
                  </span>
                </div>
              </div>
            </div>
          </div>

          <div class="row" ng-show="!comment">
            <div class="col-md-12">
              <i class="fa fa-comment-o" aria-hidden="true"></i>
              Comment :
              <a ng-click="comment = !comment">
                <i class="fa fa-chevron-circle-down" aria-hidden="true"></i>
              </a>
            </div>
          </div>

          <div class="row" ng-show="comment">
            <div class="col-md-12">
              <i class="fa fa-comment-o" aria-hidden="true"></i>
              Comment :
              <a ng-click="comment = !comment">
                <i class="fa fa-chevron-circle-up" aria-hidden="true"></i>
              </a>

              <textarea name="name" rows="4" cols="80" class="form-control"></textarea>
              <input type="checkbox" name="" value=""> แสดงข้อความ Comment
            </div>
          </div>

        </div>
      </div><!-- /.panel -->

    </div>
    <!-- right column -->
  </div><!-- /.row -->
</div><!-- /.container -->
@endsection
