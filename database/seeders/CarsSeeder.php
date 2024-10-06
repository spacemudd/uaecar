<?php

namespace Database\Seeders;

use App\Models\Car;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CarsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        //$table->string('description');
        //    $table->string('description2');
        //    $table->text('long_description');
        //    $table->string('year');
        //    $table->string('engine_size');
        //    $table->string('mileage');
        //    $table->string('price');
        //    $table->string('fuel_type');
        //    $table->string('registration');
        //    $table->string('owners');
        //    $table->string('emission_class')->nullable();

        Car::create([
            'description' => 'Mercedes-Benz G Class',
            'description2' => '4.0 G63 V8 BiTurbo AMG SpdS+9GT 4MATIC Euro 6 (s/s) 5dr',
            'long_description' => "Indulge in the ultimate luxury and performance with the 2023 Mercedes AMG G63, now available at Luxuria. With only 400 delivery miles on the clock, this stunning vehicle is guaranteed to turn heads wherever you go. The sleek black exterior paired with a matching black interior exudes sophistication and elegance, making it the perfect choice for those who appreciate the finer things in life., Equipped with satin black AMG wheels, a detachable tow bar, and full AMG specifications, the Mercedes AMG G63 is not just a car - it's a statement. Whether you're cruising through the city streets or embarking on a weekend getaway, this powerhouse will deliver an exhilarating driving experience every time., And with VAT qualifying status, you can take advantage of the incredible price of £135,195 plus VAT (20%). Don't miss out on the opportunity to own this exceptional vehicle. Contact Luxuria today to schedule a test drive and experience the luxury and performance of the Mercedes AMG G63 for yourself. Elevate your driving experience with Luxuria - where luxury meets excellence. , Black Full leather interior, Four wheel-drive, Metallic Obsidian Black, 1 owner, £167,995
<br/><br/>
Vehicle registered: 01/09/2023",
            'year' => '2023',
            'engine_size' => '4.0L',
            'mileage' => '402 miles',
            'price' => '£167,995',
            'fuel_type' => 'Petrol',
            'registration' => '2023 (73 reg)',
            'owners' => '1',
            'emission_class' => 'Euro 6',
        ]);

        Car::create([
            'description' => 'Aston Martin DB11',
            'description2' => '4.0 V8 Auto Euro 6 (s/s) 2dr',
            'long_description' => "This 2019 Aston Martin V8 Coupe is a true luxury sports car that offers a thrilling driving experience. The V8 engine delivers impressive performance, while the dynamic pack and adaptive damping ensure a smooth and responsive ride. The exquisite Obsidian Black leather interior is complemented by Spicy Red accent stitching, creating a sophisticated and sporty look. With features like heated front seats, premium audio system, and front parking sensors, this Aston Martin provides both comfort and convenience.In addition to its powerful performance and luxurious interior, this Aston Martin also boasts a sleek Onyx Black exterior with gloss black 10-spoke directional wheels, adding to its overall elegance and style. With only 13,000 miles on the odometer, this vehicle is in excellent condition and ready to hit the road.Whether you're a car enthusiast looking for a high-performance sports car or a luxury connoisseur seeking a statement-making vehicle, this Aston Martin V8 Coupe is sure to exceed your expectations. Experience the thrill of driving a true British icon - schedule a test drive today and make this stunning Aston Martin yours, This car is listed as a CAT N, which is the lowest category, it was not subject to any accident damage and repair, the car suffered a fault with keyless start, it then went to Aston Martin on its last service and was being used by inserting key instead of push start, since found it to be a module and now full repaired by Aston and with a clean bill of health. , 6 months warranty, 12 months MOT, Full service history, Excellent bodywork, Black Full leather interior - Excellent Condition, Tyre condition Good, Black, 3 owners, £68,995
<br/><br/>
Vehicle registered: 28/03/2019",
            'year' => '2019',
            'engine_size' => '4.0L',
            'mileage' => '14,400 miles',
            'price' => '£68,995',
            'fuel_type' => 'Petrol',
            'registration' => '2019 (19 reg)',
            'owners' => '3',
            'emission_class' => 'Euro 6',
        ]);

        Car::create([
            'description' => 'Land Rover Range Rover',
            'description2' => '3.0 SD V6 Vogue Auto 4WD Euro 6 (s/s) 5dr',
            'long_description' => "Range Rover Vogue 3.0 diesel packed with lots of extras listed below. Biggest features this particular model has a huge impact from first sight with its full AVR upgrade including front and rear bumpers, lower door panels, gloss black exterior pack, AVR badging and Urban Automotive 23 inch alloy wheels. To complement the exterior looks the car comes with the vogue specifications such as heated, cooled and electric seats, satin silver and gloss trims, panoramic glass opening roof, fridge, nappa leather, Meridian Surround Sound System, Dynamic LED lights, The list is endless, , FSH and next service due now, peace of mind Ghost immobiliser, you will be driving away in a fully detailed and serviced car., New in stock and seating prep so more photos to follow. , 12 months MOT, Full service history, Excellent bodywork, Black Full leather interior - Excellent Condition, Tyre condition Good, Four wheel-drive, Metallic Grey, 4 owners, £32,995
<br/><br/>
Vehicle registered: 27/09/2019",
            'year' => '2019',
            'engine_size' => '3.0L',
            'mileage' => '78,900 miles',
            'price' => '£32,995',
            'fuel_type' => 'Diesel',
            'registration' => '2019 (69 reg)',
            'owners' => '4',
            'emission_class' => 'Euro 6',
        ]);

        Car::create([
            'description' => 'Audi R8',
            'description2' => '5.2 FSI V10 Performance Carbon Black S Tronic quattro Euro 6 (s/s) 2dr',
            'long_description' => "Stunning R8 V10 Performance Carbon Black Finished In Black , All important Bang and Olufsen Sound System (not standard), With Black Nappa Leather. , Miltek Race Exhaust System, , Carbon Exterior Pack, Carbon Interior Trims, Black Exterior Styling, Carbon Door Sill Trims, Carbon Side Skirts, Carbon Side Blades, Carbon Rear Wing, Carbon Rear Diffuser, Carbon Instrument Panel Surround, Carbon Front Splitter, Carbon Mirror Housing, , 20” Anthracite Alloys With Diamond Finish, Heated R8 Bucket Seats, Red Calipers, LED Matrix Headlights, Electric Folding Mirrors, Rear Camera, Front and Rear Parking Sensors, Virtual Cockpit, Magnetic Ride, Wireless Charging, R8 Performance Steering Wheel, Climate Control, Cruise Control, Comes With Full Audi Service History., Vehicle registered: 24/09/2019 , Black, 2 owners, £109,995
<br/><br/>
Vehicle registered: 24/09/2019",
            'year' => '2019',
            'engine_size' => '5.2L',
            'mileage' => '19,500 miles',
            'price' => '£109,995',
            'fuel_type' => 'Petrol',
            'registration' => '2019 (69 reg)',
            'owners' => '2',
            'emission_class' => 'Euro 6',
        ]);

        Car::create([
            'description' => 'Audi RS6 Avant',
            'description2' => '4.0 TFSI V8 Carbon Black Tiptronic quattro Euro 6 (s/s) 5dr',
            'long_description' => "2020/70 Audi RS6 Avant Carbon Black | £81,995, RS6’s don’t come much better than this. Huge spec from factory including the full sliding panoramic sunroof, 360 Cams & Comfort/Sound package - enhanced with some subtle upgrades including 22” Gloss black Vossen HF-2 alloy wheels. , The RS6 has always been the king of the fast estates, and this latest model is the best of them all with 600 BHP running through the legendary Quattro AWD system - but with space for 5 people, a huge boot and head turning looks., New recent alternator from Audi at a cost of over £2,000!, Mythos black metallic paintwork , Panoramic glass sunroof , Comfort & Sound package , Heated & cooled seats , HD Matrix LED headlights, Full carbon exterior kit , Gloss black Vossen HF-2 alloys , Black Valcona leather RS seats , Green RS Calipers , Bang & Olufsen audio , 360 degree cameras , Virtual cockpit , Audi pre sense, Lane assist , Interior mood lighting , Dual climate control , Electric seats , Alcantara steering wheel , Dynamic all wheel steering, Heated mirrors, Carbon twill inlays , Sports exhaust with black tips , Smoked taillights , New alternator at Audi , 2 keys , 21,000 miles , Full service history , Metallic Black, 4 owners, £81,995
<br/><br/>
Vehicle registered: 05/11/2020",
            'year' => '2020',
            'engine_size' => '4.0L',
            'mileage' => '21,000 miles',
            'price' => '£81,995',
            'fuel_type' => 'Petrol',
            'registration' => '2020 (70 reg)',
            'owners' => '4',
            'emission_class' => 'Euro 6',
        ]);

        Car::create([
            'description' => 'Nissan Gt-r',
            'description2' => '3.8 V6 Recaro Auto 4WD Euro 6 2dr',
            'long_description' => "CARBON FIBRE OVERLOAD GTR RECARO LANDS INTO STOCK! THE SOUND OF THIS CAR IS JUST EPIC NOT TO MENTION THE SPEED AND POWER! NISSAN GTR 3.8 RECARO EDITION CPE (4.25 700 PS ) (PRIVATE GTR PLATE STAYING ON CAR RECENTLY VALUED AT 3500)FSH WITH LICHFIELD, AC SPEEDTECH & NISSAN LAST DONE AT 16776 MILES AND WAS A MAJOR SERVICE - ALL IN SERVICE BOOK ALONG WITH INVOICES - NO EXPENSE SPARED - ONLY 18000 MILES - Factory Optional Extras: Recaro Edition Specification - Recaro Electronic Front Seats - Pearlescent White Paintwork - 6 Piston Front Brakes - Heated Front Seats - Cruise Control - Headlight Washers - Lumbar Support___Modifications (19,986 worthj):AC Speedtech Stage 4.25 Tune with ANSU 1050cc Injectors and ACS Intakes (3,638)Carbon Fibre - Rear Spoiler, Rear Diffuser, New GTR Bonnet with Bonnet Vents, Front Splitter, Front Canards, Grill Trim, Side Skirts (4,600)T-REX GTR Pro Touchscreen System (1,282)Carbon Fibre Steering Wheel + Extended Paddle Shift - (2,200)Full TITAN Titanium Exhaust System (4,800)Alcon C Hook Front & Rear Discs + Performance Brake Pads (3,000)Michelin Pilot Sport 4s Tyres (1,000)Upgraded Black Steel Coolant Tank (150)Eibach 15mm Hub-Centric Spacers (110)Eibach 20mm Hub-Centric Spacers (116)Ghost Immobiliser (500)Global Telemetrics S5 Tracker (500) plus Autowatch system (750)V5, BOOK PACK PRESENT - HPI Clear, Service History: 20/05/2022 (16,776) GTR Specialist MAJOR SERVICE - AC Speedtech (DCT Transmission Service, Engine Oil + Filter & Differential Service with new Discs and Pads Fitted)15/01/2021 (13,820mls) GTR Specialist - AC Speedtech (Engine Oil + Filter)15/08/2020 (12,923mls) GTR Specialist - Severn Valley Motorsport (Engine Oil + Filter, Brake Fluid, Coolant & Inspection) 12/08/2020 (12,912mls) GTR Specialist - AAT Performance (Carry Out Clutch Relearn, Strip Down & Regrease Front Brakes & Inspection) 23/07/2020 (12,846mls) GTR Specialist - Race Junky Performance (Carry Out Inspection) 26/10/2019 (11,141mls) GTR Specialist - Litchfield (Warranty Inspection) 04/04/2019 (8,919mls) GTR Specialist - Litchfield (36 Month Service & Undertray , White, 5+ owners, £71,995
<br/><br/>
Vehicle registered: 01/03/2016",
            'year' => '2016',
            'engine_size' => '3.8L',
            'mileage' => '18,000 miles',
            'price' => '£71,995',
            'fuel_type' => 'Petrol',
            'registration' => '2016 (16 reg)',
            'owners' => '5',
            'emission_class' => 'Euro 6',
        ]);

        Car::create([
            'description' => 'Audi RS5',
            'description2' => '2.9 TFSI V6 Sport Edition Tiptronic quattro Euro 6 (s/s) 2dr',
            'long_description' => "Probably one of the best RS5 on the market today, Full specification and maintenance records for everything., The car has benefited from subtle upgrades such as the Miltek exhaust system, Maxton Kit all round, upgraded tinted rear lights, Stage 1 upgrade to 536ps, Full EBC brake pad upgrade. Scorpion tracker and Ghost immobilizer, Gloss black exterior and interior pack, Supersports seats.....the list is endless, full advert and spec will be up this weekend along with pictures , Silver, 3 owners, £43,995
<br/><br/>
Vehicle registered: 09/09/2019",
            'year' => '2019',
            'engine_size' => '2.9L',
            'mileage' => '35,500 miles',
            'price' => '£43,995',
            'fuel_type' => 'Petrol',
            'registration' => '2019 (69 reg)',
            'owners' => '3',
            'emission_class' => 'Euro 6',
        ]);
    }
}
