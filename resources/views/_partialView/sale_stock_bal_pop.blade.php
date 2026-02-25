<div id="expModal" class="modal fade" >
      
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" style="color:black;font-size:24px;">Delete Inventory Item</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">  
                <div class="form-group" style="margin: 0 10px;">
                    <div class="col-sm-12">
                    <table id="mytable" class="table table-bordered table-striped table-highlight">
						<thead>
						<tr bgcolor="#c7c7c7">
						<th>S/N</th>
						<th>Exp date</th>
						<th>Qty Available</th>
						<th>Action</th>
					  </tr>
					</thead>
					@php $i=1; @endphp
					@foreach($Stock_Exp_Bal as $list)					
                       <tr>
    		               <td>{{$i++}} </td>
    		               <td>{{$list->expdate}} </td>
    		               <td>{{$list->stock_bal}} </td>
						   <td><button type="button" class="btn btn-primary" name="add">Select</button></td>
						</tr>
					@endforeach
					</table>
                    </div>
                </div>
            </div>
                <div class="modal-footer">
                    
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">cancel</button>
                </div>
                
            </div>
            
         
    </div>