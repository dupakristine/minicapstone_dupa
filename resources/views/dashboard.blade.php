@extends('base')

@section('content')
<div class="text-white">
    <header class="p-4" style="
    background-color: #3498db; /* Blue color */
    box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.4);
    z-index: 1;
    position: fixed;
    width: 100%;
">
    <div class="d-flex justify-content-between align-items-center">
        <div class="text-white">
            <h1 class="p-3" style="
                font-size: 28px;
                color: #fff; /* White text */
            ">
                <i class=""></i> Your Milk Tea Shop
            </h1>
        </div>
        <div class="text-white">
            <nav>
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="/dashboard"><i class="fas fa-glass-whiskey"></i> Explore Menu</a>
                    </li>
                    @role('admin')
                    <li class="nav-item">
                        <a class="nav-link text-white" href="/logs"><i class="fas fa-users"></i> View Logs</a>
                    </li>
                    @endrole
                </ul>
            </nav>
        </div>
        <div class="text-white">
            <button
                data-toggle="modal" data-target="#confirmLogoutModal"
                class="btn btn-light rounded-lg pe-4 ps-4">
                <i class="fa-solid fa-user"></i> {{ Auth::user()->name }}
            </button>
        </div>
    </div>
</header>



<div>
    <div class="p-5">
        <div style="margin-top: 100px;">
            <h1 class="d-flex text-white float-left" style="margin-top: 20px;">
                @role('admin')
                <button style="
    background-color: #308692;
    border: none;
    color: white;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 20px;
    margin: 4px 2px;
    cursor: pointer;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
" type="button" class="btn" data-toggle="modal" data-target="#exampleModal">
    <span class="p-2 rounded-lg text-white">
        <i class="fas fa-plus"></i> Add Item
    </span>
</button>

                @endrole
            </h1> <br> <br>
            <br>

            <div style="place-content: center;" class="d-flex flex-wrap">
                @foreach ($plugins as $plugin)
                <div class="bg-info text-dark m-3"
                style="
                width: 750px;
                box-shadow: rgba(128, 101, 101, 0.4) 0px 2px 4px, rgba(77, 43, 43, 0.3) 0px 7px 13px -3px, rgba(72, 59, 59, 0.2) 0px -3px 0px inset;"
                >
                <div class="product-container">
                    
                    <img class="product-image" src="https://assets.epicurious.com/photos/629f98926e3960ec24778116/1:1/w_2560%2Cc_limit/BubbleTea_RECIPE_052522_34811.jpg" alt="">
                    <div class="product-details">
                        <h5><b>Name:</b> {{$plugin->name}}</h5>
                        <h5><b>Add Ons:</b> {{$plugin->addons}}</h5>
                        <h5><b>Description:</b> {{$plugin->description}}</h5>
                        <h5><b>Price:</b> {{$plugin->price}}</h5>
                        <h5><b>Flavor:</b> {{$plugin->flavor}}</h5>
                        <h5><b>Size:</b> {{$plugin->size}}</h5>
                    </div>
                    <div class="product-actions-mobile">
                        <form action="{{ route('plugin.download', $plugin) }}" method="POST">
                            @csrf
                            <div class="action-button">
                                @role('user')
                                <button class="btn btn-primary" data-plugin-id="{{ $plugin->id }}" onclick="submitOrderForm(this)">
                                    <i class="fa fa-milktea"></i> Order Now
                                </button>
                                @endrole
                            </div>
                        </form>
                    </div>
                    <div class="product-actions">
                        @role('admin')
                        <button type="button" class="btn text-white" data-toggle="modal" data-target="#editModal-{{ $plugin->id }}">
                            <i class="fa fa-edit"></i> Edit
                        </button>
                        <button type="button" class="btn text-danger" data-toggle="modal" data-target="#deleteModal-{{ $plugin->id }}" data-plugin-id="{{ $plugin->id }}">
                            <i class="fa fa-trash"></i> Delete
                        </button>
                        @endrole
                    </div>
                </div>
                
                
                </div>
                {{-- <div class="m-5">
                    <div class="bg-light p-5 rounded" style="
                        box-shadow: rgba(0, 0, 0, 0.4) 0px 2px 4px, rgba(0, 0, 0, 0.3) 0px 7px 13px -3px, rgba(0, 0, 0, 0.2) 0px -3px 0px inset;
                        background-color: #D2B48C; /* Milktea */
                    ">
                        <form id="orderForm_{{ $plugin->id }}" action="{{ route('plugin.download', $plugin) }}" method="POST">
                            @csrf
                            <div class="view-button d-flex justify-content-center">
                                @role('user')
                                <button class="btn btn-primary orderBtn" data-plugin-id="{{ $plugin->id }}" onclick="submitOrderForm(this)">
                                    <i class="fas fa-glass-whiskey"></i> Order Now
                                </button>
                                @endrole

                            </div>
                        </form>

                        <div class="text-center mb-5">
                            <img width="300px;" src=""">
                        </div>

                        <div class="p-2 text-dark">
                            <h5>Name: {{$plugin->name}}</h5>
                            <hr>
                            <h5>Description: {{$plugin->description}}</h5>
                            <hr>
                            <h5>Price: {{$plugin->price}}</h5>
                            <hr>
                            <h5>Flavor: {{$plugin->flavor}}</h5>
                            <hr>
                            <h5>Size: {{$plugin->size}}</h5>
                            <hr>
                        </div>
                        <div class="d-flex" style="place-content: center;">
                            @role('admin')
                            <button type="button" class="btn btn-success orderBtn" data-toggle="modal" data-target="#editModal-{{ $plugin->id }}">
                                <i class="fa fa-edit"></i> Edit
                            </button>
                            <button type="button" class="btn btn-danger orderBtn" data-toggle="modal" data-target="#deleteModal-{{ $plugin->id }}" data-plugin-id="{{ $plugin->id }}">
                                <i class="fa fa-trash"></i> Delete
                            </button>
                            @endrole
                        </div>
                    </div>
                </div> --}}


                <div id="editModal-{{ $plugin->id }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-dark text-white">
                                <h5 class="modal-title" id="editModalLabel"><b>Edit Milk Tea Item</b></h5>
                                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="editForm-{{ $plugin->id }}" method="POST" action="{{ route('plugins.update', $plugin) }}">
                                    @csrf
                                    @method('PATCH')
                
                                    <div class="form-group">
                                        <label for="name" class="text-dark">Milk Tea Name:</label>
                                        <input type="text" class="form-control" id="name" name="name" value="{{ $plugin->name }}">
                                    </div>
                
                                    <div class="form-group">
                                        <label for="price" class="text-dark">Price:</label>
                                        <input type="text" class="form-control" id="price" name="price" value="{{ $plugin->price }}">
                                    </div>
                
                                    <div class="form-group">
                                        <label for="flavor" class="text-dark">Milk Tea Flavor:</label>
                                        <select name="flavor" id="flavor" class="form-control" required>
                                            @foreach(['Classic', 'Green', 'Thai', 'Hong Kong', 'Jasmine', 'Oolong', 'Honey', 'Taro', 'Wintermelon', 'Fruit', 'Brown Sugar', 'Matcha'] as $flavor)
                                                <option value="{{ $flavor }}" {{ $flavor === $plugin->flavor ? 'selected' : '' }}>{{ $flavor }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                
                                    <div class="form-group">
                                        <label for="size" class="text-dark">Milk Tea Size:</label>
                                        <select name="size" id="size" class="form-control" required>
                                            @foreach(['Small', 'Regular', 'Large', 'Extra Large'] as $size)
                                                <option value="{{ $size }}" {{ $size === $plugin->size ? 'selected' : '' }}>{{ $size }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                
                                    <div class="form-group">
                                        <label for="description" class="text-dark">Description:</label>
                                        <textarea class="form-control" id="description" name="description" rows="5">{{ $plugin->description }}</textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="addons" class="text-dark">Add Ons:</label>
                                        <textarea class="form-control" id="addons" name="addons" rows="5">{{ $plugin->addons }}</textarea>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
                                <button type="submit" form="editForm-{{ $plugin->id }}" class="btn btn-primary"><i class="fa fa-save"></i> Save Changes</button>
                            </div>
                        </div>
                    </div>
                </div>
                


                    <!-- Delete Modal -->
                    <div id="deleteModal-{{ $plugin->id }}" class="modal fade" style="margin-top: 300px" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                        <div class="modal-dialog text-white" role="document">
                            <div class="modal-content" style="background-color: #1c3fb3;"> <!-- Updated background color -->
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Are you sure you want to delete this Item?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                    <form id="deleteForm-{{ $plugin->id }}" method="POST" action="{{ route('plugins.destroy', $plugin) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>






</div>

<div class="modal fade" id="confirmLogoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="exampleModalLabel">Confirm Logout</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to log out?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger">Confirm Logout</button>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title" id="exampleModalLabel"><b>Create Milk Tea Item</b></h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ route('plugins.store') }}">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name" class="text-dark">Milk Tea Name:</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="price" class="text-dark">Price:</label>
                        <input type="number" name="price" id="price" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="flavor" class="text-dark">Milk Tea Flavor:</label>
                        <select name="flavor" id="flavor" class="form-control" required>
                            <option value="Classic">Classic</option>
                            <option value="Green">Green</option>
                            <option value="Thai">Thai</option>
                            <option value="Hong Kong">Hong Kong</option>
                            <option value="Jasmine">Jasmine</option>
                            <option value="Oolong">Oolong</option>
                            <option value="Honey">Honey</option>
                            <option value="Taro">Taro</option>
                            <option value="Wintermelon">Wintermelon</option>
                            <option value="Fruit">Fruit</option>
                            <option value="Brown Sugar">Brown Sugar</option>
                            <option value="Matcha">Matcha</option>
                            <!-- Add more flavors here -->
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="size" class="text-dark">Milk Tea Size:</label>
                        <select name="size" id="size" class="form-control" required>
                            <option value="Small">Small</option>
                            <option value="Regular">Regular</option>
                            <option value="Large">Large</option>
                            <option value="Extra Large">Extra Large</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="description" class="text-dark">Description:</label>
                        <textarea name="description" id="description" class="form-control" required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="addons" class="text-dark">Add Ons:</label>
                        <textarea name="addons" id="addons" class="form-control" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>



<style>
    /* Order Button */
    .orderBtn {
        font-size: 20px;
        transition: 0.5s;
    }
    
    .orderBtn:hover {
        font-size: 30px;
    }

    /* Bounce Animation */
    @keyframes bounce {
        0%, 20%, 50%, 80%, 100% {
            transform: translateY(0);
        }
        40% {
            transform: translateY(-20px);
        }
        60% {
            transform: translateY(-10px);
        }
    }

    /* Apply Bounce Animation to h3 within .order-card */
    .order-card h3 {
        animation: bounce 2s infinite; /* Adjust the animation duration as needed */
    }

    /* Fade-in Animation from Left */
    @keyframes fadeInFromLeft {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }

    /* Order Card */
    .order-card {
        display: none;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: white;
        padding: 20px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        z-index: 1000;
        animation: fadeInFromLeft 0.5s ease-out; /* Adjust the animation duration and easing as needed */
    }

    /* Perspective Animation */
    .m-5 {
        perspective: 1000px;
        transition: transform 0.5s;
    }

    /* Rotate on Hover */
    .bg-secondary {
        border-radius: 20px;
        box-shadow: rgba(0, 0, 0, 0.09) 0px 2px 1px, rgba(0, 0, 0, 0.09) 0px 4px 2px, rgba(0, 0, 0, 0.09) 0px 8px 4px, rgba(0, 0, 0, 0.09) 0px 16px 8px, rgba(0, 0, 0, 0.09) 0px 32px 16px;
        transition: transform 0.5s;
    }

    .bg-secondary:hover {
        transform: rotateY(20deg);
    }

    /* View Button on Hover */
    .view-button {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(255, 255, 255, 0.8);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.5s;
    }

    .m-5:hover .view-button {
        opacity: 1;
    }

    /* Software Checkboxes */
    .software-checkboxes {
        display: flex;
        flex-direction: column;
        margin: 20px;
    }

    .form-check {
        display: flex;
        align-items: center;
    }

    .product-container {
    display: flex;
    align-items: center;
    padding: 10px;
    border: 1px solid #ccc;
    margin-bottom: 10px;
}

.product-image {
    width: 200px;
    height: auto;
    margin-right: 10px;
}

.product-details {
    flex: 1;
    display: flex;
    flex-direction: column;
}

.product-details h5 {
    margin: 0;
    font-size: 16px;
}

.product-actions {
    display: flex;
    flex-direction: column;
    align-items: flex-start; /* Align items at the top */
    justify-content: space-between;
}

.action-button {
    margin-top: 10px;
}

.edit-delete-buttons {
    display: flex;
    flex-direction: column;
    align-items: flex-start; /* Align buttons to the left */
}

.edit-delete-buttons button {
    margin-top: 10px;
}



</style>

<script>
// Function to show the "Ordering Please Wait!" card and submit the form
function submitOrderForm(button) {
    var pluginId = button.getAttribute('data-plugin-id');
    var orderCard = document.getElementById('orderCard_' + pluginId);
    orderCard.style.display = 'block';

    // Submit the form after showing the card
    var orderForm = document.getElementById('orderForm_' + pluginId);
    orderForm.submit();
}


   function updateSelectedSoftware() {
        const checkboxes = document.querySelectorAll('input[name="software"]');
        const selectedSoftware = [];

        checkboxes.forEach(checkbox => {
            if (checkbox.checked) {
                selectedSoftware.push(checkbox.value);
            }
        });

        const selectedSoftwareInput = document.getElementById('daws');
        selectedSoftwareInput.value = selectedSoftware.join(', '); // or use any other delimiter you prefer
    }
</script>

@endsection
@auth

@endauth

