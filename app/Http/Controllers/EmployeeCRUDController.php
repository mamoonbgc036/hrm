<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Disease;
use App\Models\Journal;
use App\Models\Nominee;
use App\Models\Referee;
use App\Models\Employee;
use App\Models\Gurantor;
use App\Models\Training;
use App\Models\Experience;
use App\Models\Disease_hist;
use Illuminate\Http\Request;
use App\Models\Relation_details;
use Illuminate\Support\Facades\DB;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\ProfessionalExperience;
use Illuminate\Support\Facades\Session;
use App\Models\EducationalQualification;

class EmployeeCRUDController extends Controller
{
    //
    public function storeBasicInfo(Request $req)
    {
        // logger($req);
        $req->validate([
            'pin_no' => ['required', 'unique:employees,pin_no'],
            'nid_no' => ['required', 'unique:employees,nid_no'],
            'birth_certificate_no' => ['required', 'unique:employees,birth_certificate_no'],
            'mobile_no' => ['required', 'unique:employees,mobile_no'],
            'email' => ['required', 'unique:employees,email'],
        ]);

        $name = $req->first_name . ' ' . $req->middle_name . ' ' . $req->last_name;


        $data = $req->except(['_token', 'first_name']);

        /// image
        if ($req->hasFile('img_url')) {
            $file_image = $req->file('img_url');

            $fileName = time() . '_' . $file_image->getClientOriginalName();

            // Define the destination path
            $destinationPath = public_path('profile_image');

            // Ensure the destination directory
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true); // Create the directory if it doesn't exist
            }
            $file_image->move($destinationPath, $fileName);
            $data['img_url'] = $fileName;
        }

        if ($req->hasFile('signature_url')) {
            $signature = $req->file('signature_url');

            // Generate a unique file name with a timestamp
            $sigfileName = time() . '_' . $signature->getClientOriginalName();

            // Define the destination path
            $destinationPath_sig = public_path('signature');

            // Assign the file name to the data array
            $data['signature_url'] = $sigfileName;

            // Ensure the destination directory exists
            if (!file_exists($destinationPath_sig)) {
                mkdir($destinationPath_sig, 0755, true); // Create the directory if it doesn't exist
            }

            // Move the file to the destination path
            $signature->move($destinationPath_sig, $sigfileName);
        }
        /// image end


        // Move the file to the destination directory

        $data['name'] = $name;
        $data['tentative_confirmation_date'] = $req->tentative_date;
        // signature

        // logger($req->specializeSkills);
        // Generate the URL for the file
        $employee = Employee::create($data);
        $employee_id = $employee->id;

        if (is_array($req->specializeSkills)) {
            foreach ($req->specializeSkills as $key => $value) {
                $specilizes = [
                    'name' => $value,
                ];
                $employee->speciliazes()->create($specilizes);
            }
        }

        Session::forget('employee_id');
        Session::put('employee_id', $employee_id);

        return response()->json($data);
    }

    public function storeProfileImage(Request $req)
    {
        $employee = Employee::where('id', Session::get('employee_id'))->first();
        $employee_id = $employee->id;
        return response()->json([
            'message' => 'Employee data saved successfully!',
            'employee_id' => $employee_id // Include the ID in the response
        ]);
    }

    public function workStation(Request $req)
    {
        // return response()->json($req->all());
        if (@$req->effective_salary_one) {
            $req['effective_salary'] = $req->effective_salary_one;
        }
        unset($req['effective_salary_one']);
        $req['id'] = Session::get('employee_id');
        $data = $req->except(['_token']);
        Employee::where('id', $req->id)->update($data);
        return response()->json($req->all());
    }

    public function Address(Request $req)
    {
        $data = $req->except(['_token', 'id']);
        Employee::where('id', Session::get('employee_id'))->update($data);
        logger($data);
        logger('workstation');
        return response()->json($req->all());
    }

    public function Education(Request $req)
    {
        // {
        //     "_token": "yN05QQLztaB8U3NOEZfSie2YVsc5JTmNCiGxbWgf",
        //     "id": "18",
        //     "jsc_examination": "J.S.C",
        //     "jsc_board": "Cumilla",
        //     "jsc_roll": "0607036",
        //     "jsc_registration": "0607036",
        //     "jsc_result": "4",
        //     "jsc_gpa": "420",
        //     "jsc_passing_year": "2022",
        //     "jsc_institute": "SDFSGSRFG",
        //     "ssc_examination": "S.S.C",
        //     "ssc_board": "Cumilla",
        //     "ssc_roll": "4757",
        //     "ssc_registration": null,
        //     "ssc_result": null,
        //     "ssc_subject": "Instrumentation and Process Control Technology",
        //     "ssc_passing_year": "2023",
        //     "ssc_institute": "DFHGDGFD",
        //     "hsc_examination": null,
        //     "hsc_board": null,
        //     "hsc_roll": null,
        //     "hsc_registration": null,
        //     "hsc_result": null,
        //     "hsc_subject": null,
        //     "hsc_passing_year": null,
        //     "hsc_institute": null,
        //     "graduation_examination": null,
        //     "graduation_course_duration": null,
        //     "graduation_result": null,
        //     "graduation_subject": null,
        //     "graduation_passing_year": null,
        //     "graduation_institute": null
        // }
        // return response()->json($req->all());
        EducationalQualification::where('employee_id', Session::get('employee_id'))->forceDelete();
        ProfessionalExperience::where('employee_id', Session::get('employee_id'))->forceDelete();
        // return response()->json(Session::get('employee_id'));
        $jsc = array(
            "employee_id" => Session::get('employee_id'),
            "type" => "jsc",
            "examination" => $req->jsc_examination,
            "board" => $req->jsc_board,
            "roll" => $req->jsc_roll,
            "result" => $req->jsc_result,
            "gpa" => $req->jsc_gpa ?? null,
            "subject" => "N/A",
            "duration" => "1",
            "passing_year" => $req->jsc_passing_year,
            "institute" => $req->jsc_institute
        );
        EducationalQualification::create($jsc);
        $ssc = array(
            "employee_id" => Session::get('employee_id'),
            "type" => "ssc",
            "examination" => $req->ssc_examination,
            "board" => $req->ssc_board,
            "roll" => $req->ssc_roll,
            "result" => $req->ssc_result,
            "gpa" => $req->ssc_gpa ?? null,
            "subject" => $req->ssc_subject,
            "duration" => "2",
            "passing_year" => $req->ssc_passing_year,
            "institute" => $req->ssc_institute
        );
        EducationalQualification::create($ssc);
        $hsc = array(
            "employee_id" => Session::get('employee_id'),
            "type" => "hsc",
            "examination" => $req->hsc_examination,
            "board" => $req->hsc_board,
            "roll" => $req->hsc_roll,
            "result" => $req->hsc_result,
            "gpa" => $req->hsc_gpa ?? null,
            "subject" => $req->hsc_subject,
            "duration" => "2",
            "passing_year" => $req->hsc_passing_year,
            "institute" => $req->hsc_institute
        );
        EducationalQualification::create($hsc);
        $bsc = array(
            "employee_id" => Session::get('employee_id'),
            "type" => "graduation",
            "examination" => $req->graduation_examination,
            // "board" => $req->hsc_board ?? null,
            // "roll" => $req->hsc_roll ?? null,
            "result" => $req->graduation_result,
            "gpa" => $req->graduation_gpa ?? null,
            "subject" => $req->graduation_subject,
            "duration" => $req->graduation_course_duration,
            "passing_year" => $req->graduation_passing_year,
            "institute" => $req->graduation_institute
        );
        EducationalQualification::create($bsc);

        $msc = array(
            "employee_id" => Session::get('employee_id'),
            "type" => "masters",
            "examination" => $req->masters_examination,
            "result" => $req->masters_result,
            "gpa" => $req->masters_gpa ?? null,
            "subject" => $req->masters_subject,
            "duration" => $req->masters_course_duration,
            "passing_year" => $req->masters_passing_year,
            "institute" => $req->masters_institute
        );

        EducationalQualification::create($msc);

        // $msc = array(
        //     "employee_id" => Session::get('employee_id'),
        //     "type" => "master",
        //     "examination" => $req->masters_examination,
        //     "result" => $req->masters_result,
        //     "subject" => $req->masters_subject,
        //     "duration" => $req->masters_course_duration,
        //     "passing_year" => $req->masters_passing_year,
        //     "institute" => $req->masters_institute
        // );

        // 'professional_designation' => NULL,
        // 'professional_from_date' => NULL,
        // 'professional_to_date' => NULL,
        // 'professional_organization' => NULL,
        // 'professional_duration' => NULL,
        // 'professional_responsibilities' => NULL,
        // 'professional' => 


        $responsibilities = $req->professional_responsibilities;
        $to_date = $req->professional_to_date;
        $from_date = $req->professional_from_date;
        $organization = $req->professional_organization;
        $designation = $req->professional_designation;



        if (is_array($req->professional_responsibilities) && !is_null($req->professional_responsibilities)) {
            foreach ($responsibilities as $key => $value) {
                logger($to_date[$key]);
                ProfessionalExperience::create([
                    "employee_id" => Session::get('employee_id'),
                    "responsibilities" => $value,
                    "to_date" => $to_date[$key],
                    "from_date" => $from_date[$key],
                    "organization" => $organization[$key],
                    "designation" => $designation[$key]
                ]);
            }
        }

        if (is_array($req->professional) && !is_null($req->professional)) {
            foreach ($req->professional as $key => $value) {
                ProfessionalExperience::create([
                    "employee_id" => Session::get('employee_id'),
                    "responsibilities" => $value['responsibilities'],
                    "to_date" => $value['to_date'],
                    "from_date" => $value['from_date'],
                    "organization" => $value['organization'],
                    "designation" => $value['designation']
                ]);
            }
        }

        // EducationalQualification::create($msc);
        return response()->json($jsc);
    }

    public function Experience(Request $req)
    {
        Experience::where('employee_id', Session::get('employee_id'))->forceDelete();
        $company_name = $req->company_name;
        $job_position = $req->job_position;
        $company_location = $req->company_location;
        $project_name = $req->project_name;
        $from_date = $req->from_date;
        $to_date = $req->to_date;
        $job_responsibility = $req->job_responsibility;
        if ($company_name != null) {
            for ($i = 0; $i < count($company_name); $i++) {
                $data = array(
                    "employee_id" => Session::get('employee_id'),
                    "company_name" => $company_name[$i],
                    "job_position" => $job_position[$i],
                    "company_location" => $company_location[$i],
                    "project_name" => $project_name[$i],
                    "from_date" => $from_date[$i],
                    "to_date" => $to_date[$i],
                    "job_responsibility" => $job_responsibility[$i]
                );
                Experience::create($data);
            }
        }

        logger(Session::get('employee_id'));
        logger('Experience');
        return response()->json($req->all());
    }

    public function Family(Request $req)
    {
        // logger($req->all());
        // return;
        // {
        //     "_token": "ZxDkiZQTCShZEKXsmyzvdHb2K81zhE0sEfv1ARGm",
        //     "id": "16",
        //     "relationship": [
        //         "Sister"
        //     ],
        //     "relation_name": [
        //         "SADFSDAFDF"
        //     ],
        //     "relation_occupation": [
        //         "SDFSDAFDSF"
        //     ],
        //     "relation_contact": [
        //         "ME@MYDOMAIN.COM"
        //     ],
        //     "relation_dob": [
        //         "2004-01-06"
        //     ]
        // }
        // Gurantor::where('employee_id', Session::get('employee_id'))->forceDelete();
        // Referee::where('employee_id', Session::get('employee_id'))->forceDelete();
        // Relation_details::where('employee_id', Session::get('employee_id'))->forceDelete();

        $gurantor_imgs = Gurantor::where('employee_id', Session::get('employee_id'))->get();
        $gurantors = Gurantor::where('employee_id', Session::get('employee_id'))->forceDelete();
        // if ($gurantors->isNotEmpty()) {
        //     foreach ($gurantors as $gurantor) {
        //         $gurantor->forceDelete();
        //     }
        // }

        logger($gurantor_imgs);
        $referees = Referee::where('employee_id', Session::get('employee_id'))->get();
        if ($referees->isNotEmpty()) {
            foreach ($referees as $referee) {
                $referee->forceDelete();
            }
        }
        $relation_details = Relation_details::where('employee_id', Session::get('employee_id'))->get();
        if ($relation_details->isNotEmpty()) {
            foreach ($relation_details as $key => $relation_detail) {
                $relation_detail->forceDelete();
            }
        }

        // return response()->json($req->gurantor_name);
        // 
        $refereeNames = $req->referee_name; // Assuming this is an array
        $refereeOrganizationIds = $req->referee_organization_id; // Assuming this is an array
        $refereeOccupations = $req->referee_occupation; // Assuming this is an array
        $refereeContacts = $req->referee_contact; // Assuming this is an array
        $refereeEmail = $req->referee_email;
        // 
        $relationships = $req->relationship; // This should be an array
        $relationNames = $req->relation_name; // Assuming this is also an array
        $relationOccupations = $req->relation_occupation; // Assuming this is also an array
        $relationContacts = $req->relation_contact; // Assuming this is also an array
        $relationDobs = $req->relation_dob; // Assuming this is also an array

        $guarantorNames = $req->gurantor_name;
        $guarantorOrganizationIds = $req->gurantor_organization_id;
        $guarantorOccupations = $req->gurantor_occupation;
        $guarantorContacts = $req->gurantor_contact;
        $relations = $req->garantor_relations;

        $gurantor_images = [];
        $signatures = [];

        if ($req->hasFile('guarantor_image')) {
            $file_image = $req->file('guarantor_image');
            foreach ($file_image as $key => $image) {
                $fileName = time() . '_' . $image->getClientOriginalName();
                $destinationPath = public_path('guarantor_image');
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0755, true);
                }
                $image->move($destinationPath, $fileName);
                $gurantor_images[$key] = $fileName; // Associate image with index
            }
        }

        if ($req->hasFile('guarantor_signature')) {
            $signature_images = $req->file('guarantor_signature');
            foreach ($signature_images as $key => $sign_image) {
                $sign_img = time() . '_' . $sign_image->getClientOriginalName();
                $destinationPath = public_path('guarantor_signature');
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0755, true);
                }
                $sign_image->move($destinationPath, $sign_img);
                $signatures[$key] = $sign_img; // Associate signature with index
            }
        }

        if ($guarantorNames != null) {
            for ($i = 0; $i < count($guarantorNames); $i++) {
                if (!empty($guarantorNames[$i])) {
                    try {
                        $gurantor_info = [
                            "gurantor_name" => $guarantorNames[$i],
                            "gurantor_occupation" => $guarantorOccupations[$i] ?? null,
                            'images' => $gurantor_images[$i] ?? $gurantor_imgs[$i]->images ?? null,
                            'signature' => $signatures[$i] ?? $gurantor_imgs[$i]->signature ?? null,
                            'relations' => $relations[$i] ?? null,
                            "gurantor_contact" => $guarantorContacts[$i] ?? null,
                            "gurantor_organization_id" => $guarantorOrganizationIds[$i] ?? null,
                            "employee_id" => Session::get('employee_id'),
                        ];
                        Gurantor::create($gurantor_info);
                    } catch (\Exception $e) {
                        logger('Error inserting guarantor: ' . $e->getMessage());
                    }

                }
            }
        }

        if ($refereeNames != null) {
            for ($i = 0; $i < count($refereeNames); $i++) {
                if ($refereeNames[$i] != null) {
                    $referee = array(
                        "referee_name" => @$refereeNames[$i],
                        "referee_occupation" => @$refereeOccupations[$i],
                        "referee_contact" => @$refereeContacts[$i],
                        "email" => $refereeEmail[$i] ?? null,
                        "referee_organization_id" => @$refereeOrganizationIds[$i],
                        "employee_id" => Session::get('employee_id'),
                    );
                    Referee::create($referee);
                }
            }
        }
        if ($relationships != null) {
            for ($i = 0; $i < count($relationships); $i++) {
                $referee = array(
                    "relationship" => @$relationships[$i],
                    "relation_name" => @$relationNames[$i],
                    "relation_occupation" => @$relationOccupations[$i],
                    "relation_contact" => @$relationContacts[$i],
                    "relation_dob" => @$relationDobs[$i],
                    "employee_id" => Session::get('employee_id'),
                );
                Relation_details::create($referee);
            }
        }

        logger(Session::get('employee_id'));
        logger('Family');
        return response()->json('ok');
    }

    public function Journal(Request $req)
    {
        Journal::where('employee_id', Session::get('employee_id'))->forceDelete();
        $titles = $req->title;
        // return response()->json($titles);
        foreach ($titles as $key => $title) {
            // Insert each journal into the database

            Journal::create([
                'employee_id' => Session::get('employee_id'),
                'title' => $title,
                'publication' => $req->publication[$key],
                'publication_date' => $req->publication_date[$key],
                'author' => $req->author[$key],
                'publication_url' => $req->publication_url[$key],
            ]);
        }

        logger(Session::get('employee_id'));
        logger('Journal');
        return response()->json($req->all());
    }

    public function Nominee(Request $req)
    {
        Nominee::where('employee_id', Session::get('employee_id'))->forceDelete();
        // Retrieve nominees safely as an array
        $nominee_names = $req->name;
        $nominee_relations = $req->relationship;
        $nominee_dob = $req->dob;
        $nominee_nid = $req->nid_no;
        $nominee_address = $req->permanent_address;
        $nominee_percentage = $req->percentage;
        // Check if it's actually an array
        $nominees_imgs = [];
        if ($req->hasFile('picture')) {
            $nominee_images = $req->file('picture');
            foreach ($nominee_images as $key => $nom_image) {
                $image = time() . '_' . $nom_image->getClientOriginalName();
                $destinationPath = public_path('nominee_picture');
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0755, true);
                }
                $nom_image->move($destinationPath, $image);
                array_push($nominees_imgs, $image);
            }
        }

        $nominees_signatures = [];
        if ($req->hasFile('signature')) {
            $nom_signatures = $req->file('signature');
            foreach ($nom_signatures as $key => $nom_sign) {
                $image = time() . '_' . $nom_sign->getClientOriginalName();
                $destinationPath = public_path('nominee_signature');
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0755, true);
                }
                $nom_sign->move($destinationPath, $image);
                array_push($nominees_signatures, $image);
            }
        }
        if (is_array($nominee_names)) {
            foreach ($nominee_names as $index => $nomineeData) {
                // Perform your insert or processing logic here
                Nominee::create([
                    'employee_id' => Session::get('employee_id'),
                    'name' => $nominee_names[$index] ?? null,
                    'relationship' => $nominee_relations[$index] ?? null,
                    'dob' => $nominee_dob[$index] ?? null,
                    'picture_url' => $nominees_imgs[$index] ?? null,
                    'signature' => $nominees_signatures[$index] ?? null,
                    'nid_no' => $nominee_nid[$index] ?? null,
                    'permanent_address' => $nominee_address[$index] ?? null,
                    'percentage' => $nominee_percentage[$index] ?? null, // Handle percentages if relevant
                ]);
            }
        } else {
        }

        logger(Session::get('employee_id'));
        logger('nominiee');

        return response()->json($req->all());
    }
    public function Emergency(Request $req)
    {
        Contact::where('employee_id', Session::get('employee_id'))->forceDelete();
        // $e_contact_person_name = $req->e_contact_person_name;
        // $e_contact_person_number = $req->e_contact_person_number;
        // $e_contact_person_email = $req->e_contact_person_email;
        // $e_contact_person_address = $req->e_contact_person_address;


        $contacts = $req->contact;


        foreach ($contacts as $key => $contact) {
            $contact['employee_id'] = Session::get('employee_id');
            logger($contact);
            Contact::create($contact);
        }
        return response()->json('test420');
    }

    public function Training(Request $req)
    {
        Training::where('employee_id', Session::get('employee_id'))->forceDelete();
        $trainings = $req->training;
        foreach ($trainings as $training) {
            $training['employee_id'] = Session::get('employee_id');
            logger($training);
            Training::create($training);
        }
        return response()->json($req->all());
    }

    public function Disease(Request $req)
    {
        $errors = [];
        // $disease_name = $req->disease;
        Disease_hist::where('employee_id', Session::get('employee_id'))->forceDelete();

        if (Session::get('employee_id') != null) {
            $employee_data = Employee::findOrFail(Session::get('employee_id'));
        }
        if (Session::get('employee_id') == null) {
            $errors['employee_id'] = 'Employee ID is required.';
        } elseif (empty($employee_data)) {
            $errors['employee_name'] = 'Employee name is required';
        }

        if (!empty($errors)) {
            return redirect()->back()->withErrors($errors);
        }

        $disease = $req->disease;
        $disease_description = $req->disease_description;
        $disease_name = $req->disease_name;

        if ($disease != null) {
            for ($i = 0; $i < count($disease); $i++) {
                if (!empty($disease[$i])) {
                    $data = array(
                        "employee_id" => Session::get('employee_id'),
                        "disease_id" => $disease[$i],
                        "disease_description" => $disease_description[$i],
                    );
                    Disease_hist::create($data);
                }
            }
        }
        // if (is_array($disease_name) && sizeof($disease_name) > 1) {
        //     for ($i = 1; $i < sizeof($disease_name); $i++) {
        //         Disease_hist::create([
        //             'employee_id' => Session::get('employee_id'),
        //             'disease_id' => $disease_name[$i]['disease_id'],
        //             'disease_description' => $disease_name[$i]['disease_description']
        //         ]);
        //     }
        // }
        Session::forget('employee_id');
        Session::put('created', 'yes');
        logger(Session::get('employee_id'));
        return redirect()->route('employee.index');
    }

    public function updateBasicInfo(Request $req)
    {
        // $employee = Employee::findOrFail(Session::get('employee_id'));
        $data = $req->except(['_token', 'first_name']);
        $name = $req->first_name . ' ' . $req->middle_name . ' ' . $req->last_name;
        if ($req->hasFile('img_url')) {
            $file_image = $req->file('img_url');

            $fileName = time() . '_' . $file_image->getClientOriginalName();

            // Define the destination path
            $destinationPath = public_path('profile_image');

            // Ensure the destination directory
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true); // Create the directory if it doesn't exist
            }
            $file_image->move($destinationPath, $fileName);
            $data['img_url'] = $fileName;
        }

        if ($req->hasFile('signature_url')) {
            $signature = $req->file('signature_url');

            // Generate a unique file name with a timestamp
            $sigfileName = time() . '_' . $signature->getClientOriginalName();

            // Define the destination path
            $destinationPath_sig = public_path('signature');

            // Assign the file name to the data array
            $data['signature_url'] = $sigfileName;

            // Ensure the destination directory exists
            if (!file_exists($destinationPath_sig)) {
                mkdir($destinationPath_sig, 0755, true); // Create the directory if it doesn't exist
            }

            // Move the file to the destination path
            $signature->move($destinationPath_sig, $sigfileName);
        }

        // Move the file to the destination directory
        $data['name'] = $name;
        $data['tentative_date'] = $req->tentative_date;
        $data['tentative_confirmation_date'] = $req->tentative_date;
        // signature


        // Generate the URL for the file done

        // logger($req->id . ' id by $req->id in update');
        $employee = Employee::with('speciliazes')->findOrFail(Session::get('employee_id'));

        $employee->update($data);
        if (!$employee->speciliazes->isEmpty()) {
            $employee->speciliazes()->delete();
        }
        if (is_array($req->specializeSkills)) {
            foreach ($req->specializeSkills as $key => $value) {
                $specilizes = [
                    // 'employee_id' => Session::get('employee_id'),
                    'name' => $value,
                ];
                $employee->speciliazes()->create($specilizes);
            }
        }
        return response()->json($employee);
    }
}


