<x-backendtemplate>

	<!-- Breadcubs Area Start Here -->
        <div class="breadcrumbs-area">
            <h3>Accounts</h3>
            <ul>
                <li>
                    <a href="index.html">Home</a>
                </li>
                <li>All Expense</li>
            </ul>
        </div>
    <!-- Breadcubs Area End Here -->

    <!-- Expanse Table Area Start Here -->
        <div class="card height-auto">
            <div class="card-body">
                <div class="heading-layout1">
                    <div class="item-title">
                        <h3>All Expenses</h3>
                    </div>
                   <div class="dropdown">
                        <a class="dropdown-toggle" href="#" role="button" 
                        data-toggle="dropdown" aria-expanded="false">...</a>

                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="#"><i class="fas fa-times text-orange-red"></i>Close</a>
                            <a class="dropdown-item" href="#"><i class="fas fa-cogs text-dark-pastel-green"></i>Edit</a>
                            <a class="dropdown-item" href="#"><i class="fas fa-redo-alt text-orange-peel"></i>Refresh</a>
                        </div>
                    </div>
                </div>
                <form class="mg-b-20">
                    <div class="row g-3">
                        <div class="col-xl-3 col-lg-3 col-12 form-group">
                            <input type="text" placeholder="Search by ID ..." class="form-control">
                        </div>
                        <div class="col-xl-4 col-lg-3 col-12 form-group">
                            <input type="text" placeholder="Search by Name ..." class="form-control">
                        </div>
                        <div class="col-xl-3 col-lg-3 col-12 form-group">
                            <input type="text" placeholder="Search by Phone" class="form-control">
                        </div>
                        <div class="col-xl-2 col-lg-3 col-12 form-group">
                            <button type="submit" class="fw-btn-fill btn-gradient-yellow">SEARCH</button>
                        </div>
                    </div>
                </form>
                <div class="table-responsive">
                    <table class="table data-table text-nowrap">
                        <thead>
                            <tr>
                                <th> 
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input checkAll">
                                        <label class="form-check-label">ID</label>
                                    </div>
                                </th>
                                <th>Name</th>
                                <th>Expense Type</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Phone</th>
                                <th>E-mail</th>
                                <th>Date</th>
                                <th></th>
                            </tr>
                        </thead>
                       	<tbody>
                       		<tr>
                       			<td></td>
                       			<td></td>
                       			<td></td>
                       			<td></td>
                       			<td></td>
                       			<td></td>
                       			<td></td>
                       			<td></td>
                       			<td></td>
                       			
                       		</tr>
                       	</tbody>
                    </table>
                </div>
            </div>
        </div>
    <!-- Expanse Table Area End Here -->

</x-backendtemplate>