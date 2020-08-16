$(document).ready(function () {
	$('#shoppingcart_table').on('click','.plus_btn',function(){
		var id=$(this).data('id');
		var itemString=localStorage.getItem('cart');
		var itemArray=JSON.parse(itemString);

		//console.log(itemArray);

		$.each(itemArray,function(i,v){
			if(i==id){
				v.qty++;
			

			}
		})
		 cart=JSON.stringify(itemArray);
		localStorage.setItem("cart",cart);
		showTable();
		cartNoti();
	});

	$('#shoppingcart_table').on('click','.minus_btn',function(){
		var id=$(this).data('id');
		var itemString=localStorage.getItem('cart');
		var itemArray=JSON.parse(itemString);

		//console.log(itemArray);

		$.each(itemArray,function(i,v){
			if(i==id){
				v.qty--;
				if(v.qty==0){
					itemArray.splice(id,1);
				}
			

			}
		})
		 cart=JSON.stringify(itemArray);
		localStorage.setItem("cart",cart);
		showTable();
		cartNoti();
	});

	$('#shoppingcart_table').on('click','.remove',function(){
		var id=$(this).data('id');
		var itemString=localStorage.getItem('cart');
		var itemArray=JSON.parse(itemString);

		//console.log(itemArray);

		
				itemArray.splice(id,1);
				
		 cart=JSON.stringify(itemArray);
		localStorage.setItem("cart",cart);
		showTable();
		cartNoti();
	});

	cartNoti();
	showTable();
	$('.addtocartBtn').on('click',function(){
		var id=$(this).data('id');
		var name=$(this).data('name');
		var codeno=$(this).data('codeno');
		var photo=$(this).data('photo');
		var price=$(this).data('price');
		var discount=$(this).data('discount');
		var qty=1;

		var mylist={id:id,
					codeno:codeno,
					name:name,
					photo:photo,
					price:price,
					discount:discount,
					qty:qty};

		var cart=localStorage.getItem('cart');
		var cartArray;
		if(cart==null){
			cartArray=Array();

		}else {
			cartArray=JSON.parse(cart);
		}

		var status=false;

		$.each(cartArray,function (i,v) {
			if(id==v.id){
				v.qty++;
				status=true;
			}
		});
		if(!status){
			cartArray.push(mylist);
		}

		var cartData=JSON.stringify(cartArray);
		localStorage.setItem("cart",cartData);

		cartNoti();

	});

	function cartNoti() {
		var cart=localStorage.getItem('cart');
		if(cart){
			var cartArray=JSON.parse(cart);

			var total=0;
			var noti=0;

			$.each(cartArray, function (i,v) {
				var unitprice=v.price;
				var discount=v.discount;
				var qty=v.qty;
				if(discount){
					var price=unitprice-discount;
				}else {
					var price=unitprice;
				}
				var subtotal=price*qty;
				noti += qty++;
				total += subtotal++;

			})
			$('.cartNoti').html(noti);
			$('.cartTotal').html(total+'Ks');

		}else {
			$('.cartNoti').html(0);
			$('.cartTotal').html(0+'Ks');
		}
	}

	function showTable(){
		var cart=localStorage.getItem('cart');

		if(cart){

			$('.shoppingcart_div').show();
			$('.noneshoppingcart_div').hide();

			var cartArray=JSON.parse(cart);
			var shoppingcartData='';

			if(cartArray.length > 0){
				var total=0;
				$.each(cartArray,function (i,v) {
					var id=v.id;
					var codeno=v.codeno;
					var name=v.name;
					var unitprice=v.price;
					var discount=v.discount;
					var photo=v.photo;
					var qty=v.qty;
					
					if(discount){
						var price=unitprice-discount;
					}else {
						var price=unitprice;
					}
					var subtotal = price*qty;

					shoppingcartData += `<tr>
											<td><button class="btn btn-outline-danger remove btn-sm" data-id=${i} style="border-radius: 50%"> 
													<i class="icofont-close-line"></i> 
												</button> 
											</td>
											<td>
												<img src="${photo}" class="cartImg">
											</td>
											<td>
												<p> ${name} </p>
												<p> ${codeno}</p>
											</td>
											<td><button class="btn btn-outline-secondary plus_btn" data-id=${i}> 
													<i class="icofont-plus"></i> 
												</button>
											</td>
											<td class="qty" data-id=${i}> ${qty} </td>
											<td><button class="btn btn-outline-secondary minus_btn" data-id=${i}> 
													<i class="icofont-minus"></i>
												</button>
											</td>
											<td>`;
					if(discount){
						discount=unitprice-discount;
						shoppingcartData += `<p class="text-danger"> 
												${discount} Ks
											</p>
											<p class="font-weight-lighter">
												<del>${unitprice}Ks</del>
											</p>`;

					}else {
						shoppingcartData += `<p class="font-weight-lighter">
												${unitprice}Ks
											</p>`;
					}

					shoppingcartData +=	`</td>
											<td>
												<p> ${subtotal}Ks</p>
											</td>
										</tr>`;

					total += subtotal++;
				});

				$('#shoppingcart_table').html(shoppingcartData);

			}else {
				$('.shoppingcart_div').hide();
				$('.noneshoppingcart_div').show();
			}

		}else {
			$('.shoppingcart_div').hide();
			$('.noneshoppingcart_div').show();
			
		}
	}

	$('.checkoutbtn').on('click',function(){
		//console.log('checkoutbtn');
		var cart=localStorage.getItem('cart');
		var cartArray=JSON.parse(cart);

		var note=$('#notes').val();

		$.post('storeorder.php',{
			cart:cartArray,
			note:note
		},function(response){
			localStorage.clear();
			location.href="ordersuccess.php";

		});
		console.log(note);
	});
	



})