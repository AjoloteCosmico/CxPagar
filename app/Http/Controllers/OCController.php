<?php

namespace App\Http\Controllers;
use Session;
use App\Models\Authorization;
use App\Models\Requisition;
use App\Models\Coin;

use App\Models\Cobro;
use App\Models\Factures;
use App\Models\CreditNote;
use App\Models\CompanyProfile;
use App\Models\Customer;
use App\Models\CustomerShippingAddress;
use App\Models\CustomerContact;
use App\Models\Item;
use App\Models\Seller;
use App\Models\TempInternalOrder;
use App\Models\TempItem;
use App\Models\vinternal_orders;
use App\Models\order_contacts;
use App\Models\comissions;
use App\Models\temp_comissions;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\payments;
use App\Models\historical_payments;
use App\Models\signatures;
use App\Models\User;
use Illuminate\Support\Facades\Hash; 
use Illuminate\Support\Facades\Auth;

class OCController extends RequisitionController
{
    // OCController hereda todos los métodos de RequisitionController
    // Se pueden sobreescribir métodos aquí si se requiere comportamiento distinto

}
