<?php

use Illuminate\Http\Request;
use App\Contact;

Route::middleware( 'auth:api' )->get( '/user', function ( Request $request ) {
	return $request->user();
} );

Route::group( [ 'middleware' => 'api' ], function () {
	// fetch contacts
	Route::get( 'contacts', function () {
		return Contact::latest()->orderBy( 'created_at')->get();
	} );
	// fetch single contact
	Route::get( 'contacts/{id}', function ( $id ) {
		return Contact::findOrFail( $id );
	} );
	// store contact
	Route::post( 'contacts/store', function ( Request $request ) {
		Contact::create( [
			'name'  => $request->name,
			'email' => $request->email,
			'phone' => $request->phone
		] );
		return response()->json(['message' => 'created', 'status' => 200]);
	} );
	// update contact
	Route::patch( 'contacts/{id}', function ( Request $request, $id ) {
		Contact::findOrFail( $id )->update( [
			'name'  => $request->name,
			'email' => $request->email,
			'phone' => $request->phone
		] );
	} );
	// delete contact
	Route::delete( 'contacts/{id}', function ( $id ) {
		return Contact::destroy( $id );
	} );
} );
