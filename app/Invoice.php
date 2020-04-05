<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use SoftDeletes;

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'invoice_prefix',
        'invoice_id',
        "customer_name",
        "email",
        "invoice_due_date",
        "booking_handled_by",
        "travel_date",
        "contact_number",
        "tax_details",
        "travel_location",
        "travel_type",
        "customer_type",
        "currency",
        "service_name",
        "no_of_persons",
        "per_person_price",
        "tax",
        "tour_itinerary",
        "inclusion",
        "exclusion",
        'updated_at',
        'deleted_at',
    ];
}
