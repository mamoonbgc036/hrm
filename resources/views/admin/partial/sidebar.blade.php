<ul class="app-menu">
    @can('Dashboard')
        <li>
            <a class="app-menu__item {{ Request::segment(1) == 'home' ? '' : 'active' }}" href="{{ url('/') }}">
                <i class="app-menu__icon fa fa-dashboard"></i>
                <span class="app-menu__label"> Dashboard</span>
            </a>
        </li>
    @endcan

    @can('Employee list')
        <li>
            <a class="app-menu__item {{ Request::segment(1) == 'employee' ? '' : 'active' }}"
                href="{{ route('employee.index') }}">
                <i class="app-menu__icon fa fa-user"></i>
                <span class="app-menu__label"> Employee</span>
            </a>
        </li>
    @endcan

    @can('Job history list')
        <li>
            <a class="app-menu__item {{ Request::segment(1) == 'posting-record' ? '' : 'active' }}"
                href="{{ route('posting-record.index') }}">
                <i class="app-menu__icon fa fa-sticky-note-o"></i>
                <span class="app-menu__label">Job History</span>
            </a>
        </li>
    @endcan

    {{-- @can('Job history list')
        <li>
            <a class="app-menu__item {{ Request::segment(1) == 'posting-recordss' ? '' : 'active' }}"
                href="{{ route('posting-recordss.transfers') }}">
                <i class="app-menu__icon fa fa-sticky-note-o"></i>
                <span class="app-menu__label">Transfer</span>
            </a>
        </li>
    @endcan --}}

    <li>
        <a class="app-menu__item {{ Request::segment(1) == 'employee-transfer' ? '' : 'active' }}"
            href="{{ route('transfer.index') }}">
            <i class="app-menu__icon fa fa-sticky-note-o"></i>
            <span class="app-menu__label">Transfer</span>
        </a>
    </li>

    <li>
        <a class="app-menu__item {{ Request::segment(1) == 'employee-confirmation' ? '' : 'active' }}"
            href="{{ route('confirmation.index') }}">
            <i class="app-menu__icon fa fa-sticky-note-o"></i>
            <span class="app-menu__label">Confirmation</span>
        </a>
    </li>

    <li>
        <a class="app-menu__item {{ Request::segment(1) == 'redesignation' ? '' : 'active' }}"
            href="{{ route('redesignation') }}">
            <i class="app-menu__icon fa fa-sticky-note-o"></i>
            <span class="app-menu__label">Redesignation</span>
        </a>
    </li>

    <li>
        <a class="app-menu__item {{ Request::segment(1) == 'employee-promotion' ? '' : 'active' }}"
            href="{{ route('promotion.index') }}">
            <i class="app-menu__icon fa fa-sticky-note-o"></i>
            <span class="app-menu__label">Promotion</span>
        </a>
    </li>


    {{-- @can('Punishment list')
        <li>
            <a class="app-menu__item {{ Request::segment(1) == 'punishment' ? '' : 'active' }}"
                href="{{ route('punishment.index') }}">
                <i class="app-menu__icon fa fa-gavel"></i>
                <span class="app-menu__label">Disciplinary Action</span>
            </a>
        </li>
    @endcan --}}

    @can('Punishment list')
        <li>
            <a class="app-menu__item {{ Request::segment(1) == 'employee-punishment' ? '' : 'active' }}"
                href="{{ route('employee.punishment') }}">
                <i class="app-menu__icon fa fa-gavel"></i>
                <span class="app-menu__label">Disciplinary Action</span>
            </a>
        </li>
    @endcan

    <li>
        <a class="app-menu__item {{ Request::segment(1) == 'employee-discontinuation' ? '' : 'active' }}"
            href="{{ route('employee.discontinuation') }}">
            <i class="app-menu__icon fa fa-gavel"></i>
            <span class="app-menu__label">Discontinuation</span>
        </a>
    </li>

    {{-- @can('Award list')
        <li>
            <a class="app-menu__item {{ Request::segment(1) == 'award' ? '' : 'active' }}"
                href="{{ route('award.index') }}">
                <i class="app-menu__icon fa fa-trophy"></i>
                <span class="app-menu__label"> Award</span>
            </a>
        </li>
    @endcan --}}

    @can('Leave list')
        <li>
            <a class="app-menu__item {{ Request::segment(1) == 'leave' ? '' : 'active' }}"
                href="{{ route('leave.index') }}">
                <i class="app-menu__icon fa fa-trophy"></i>
                <span class="app-menu__label"> Leave</span>
            </a>
        </li>
    @endcan

    {{-- @can('Achievement list')
        <li>
            <a class="app-menu__item {{ Request::segment(1) == 'achievement' ? '' : 'active' }}"
                href="{{ route('achievement.index') }}">
                <i class="app-menu__icon fa fa-trophy"></i>
                <span class="app-menu__label"> Achievement</span>
            </a>
        </li>
    @endcan --}}

    @can('Abroad training list')
        <li>
            <a class="app-menu__item {{ Request::segment(1) == 'foreign-training' ? '' : 'active' }}"
                href="{{ route('foreign-training.index') }}">
                <i class="app-menu__icon fa fa-graduation-cap"></i>
                <span class="app-menu__label"> Abroad Training</span>
            </a>
        </li>
    @endcan

    @can('Inland training list')
        <li>
            <a class="app-menu__item {{ Request::segment(1) == 'local-training' ? '' : 'active' }}"
                href="{{ route('local-training.index') }}">
                <i class="app-menu__icon fa fa-graduation-cap"></i>
                <span class="app-menu__label"> Inlandss Training</span>
            </a>
        </li>
    @endcan

    <li>
        <a class="app-menu__item {{ Request::segment(1) == 'staff-case' ? '' : 'active' }}"
            href="{{ route('staff.case') }}">
            <i class="app-menu__icon fa fa-graduation-cap"></i>
            <span class="app-menu__label">Staff Course Case</span>
        </a>
    </li>

    @can('Inhouse training list')
        <li>
            <a class="app-menu__item {{ Request::segment(1) == 'inhouse-training' ? 'active' : '' }}"
                href="{{ route('inhouse-training.index') }}">
                <i class="app-menu__icon fa fa-graduation-cap"></i>
                <span class="app-menu__label"> Inhouse Training</span>
            </a>
        </li>
    @endcan

    @can('Station menu')
        <li
            class="treeview {{ Request::segment(1) == 'station-category' || Request::segment(1) == 'station' ? 'is-expanded' : '' }}">
            <a class="app-menu__item" href="#" data-toggle="treeview">
                <i class="app-menu__icon fa fa-database"></i>
                <span class="app-menu__label">Branch</span>
                <i class="treeview-indicator fa fa-angle-right"></i>
            </a>
            <ul class="treeview-menu">
                @can('Station category list')
                    <li>
                        <a class="treeview-item {{ Request::segment(1) == 'station-category' ? 'active' : '' }}"
                            href="{{ route('station-category.index') }}"><i class="icon fa fa-th-large"></i>Office/Branch
                            Category</a>
                    </li>
                @endcan
                @can('Station list')
                    <li>
                        <a class="treeview-item {{ Request::segment(1) == 'station' ? 'active' : '' }}"
                            href="{{ route('station.index') }}"><i class="icon fa fa-university"></i>Branch</a>
                    </li>
                @endcan
            </ul>
        </li>
    @endcan

    @can('Core data menu')
        <li
            class="treeview {{ Request::segment(1) == 'department' ||
            Request::segment(1) == 'sub-department' ||
            Request::segment(1) == 'designation' ||
            Request::segment(1) == 'division' ||
            Request::segment(1) == 'district' ||
            Request::segment(1) == 'upazila' ||
            Request::segment(1) == 'relationship' ||
            Request::segment(1) == 'quota' ||
            Request::segment(1) == 'grade' ||
            Request::segment(1) == 'office' ||
            Request::segment(1) == 'subject' ||
            Request::segment(1) == 'institute' ||
            Request::segment(1) == 'batch' ||
            Request::segment(1) == 'organization' ||
            Request::segment(1) == 'location' ||
            Request::segment(1) == 'sub-location' ||
            Request::segment(1) == 'action'
                ? 'is-expanded'
                : '' }}">
            <a class="app-menu__item" href="#" data-toggle="treeview">
                <i class="app-menu__icon fa fa-database"></i>
                <span class="app-menu__label">Core Data</span>
                <i class="treeview-indicator fa fa-angle-right"></i>
            </a>
            <ul class="treeview-menu">
                <li>
                    <a class="treeview-item {{ Request::segment(1) == 'job-position' ? 'active' : '' }}"
                        href="{{ route('job_position') }}">Add Job Position</a>
                </li>
                @can('Department list')
                    <li>
                        <a class="treeview-item {{ Request::segment(1) == 'department' ? 'active' : '' }}"
                            href="{{ route('department.index') }}">Department</a>
                    </li>
                @endcan
                {{-- @can('Sub department list')
                    <li>
                        <a class="treeview-item {{ Request::segment(1) == 'sub-department' ? 'active' : '' }}"
                            href="{{ route('sub-department.index') }}">Sub Department</a>
                    </li>
                @endcan --}}
                <li>
                    <a class="treeview-item {{ Request::segment(1) == 'designation' ? 'active' : '' }}"
                        href="{{ route('specialized.index') }}">Specialized</a>
                </li>
                @can('Designation list')
                    <li>
                        <a class="treeview-item {{ Request::segment(1) == 'designation' ? 'active' : '' }}"
                            href="{{ route('designation.index') }}">Designation</a>
                    </li>
                @endcan
                @can('Division list')
                    <li>
                        <a class="treeview-item {{ Request::segment(1) == 'division' ? 'active' : '' }}"
                            href="{{ route('division.index') }}">Division</a>
                    </li>
                @endcan
                @can('District list')
                    <li>
                        <a class="treeview-item {{ Request::segment(1) == 'district' ? 'active' : '' }}"
                            href="{{ route('district.index') }}">District</a>
                    </li>
                @endcan
                @can('Upazila list')
                    <li>
                        <a class="treeview-item {{ Request::segment(1) == 'upazila' ? 'active' : '' }}"
                            href="{{ route('upazila.index') }}">Upazila</a>
                    </li>
                @endcan
                <li>
                    <a class="treeview-item {{ Request::segment(1) == 'village' ? 'active' : '' }}"
                        href="{{ route('village.index') }}">Village</a>
                </li>
                @can('Relationship list')
                    <li>
                        <a class="treeview-item {{ Request::segment(1) == 'relationship' ? 'active' : '' }}"
                            href="{{ route('relationship.index') }}">Relationship</a>
                    </li>
                @endcan
                @can('Quota list')
                    <li>
                        <a class="treeview-item {{ Request::segment(1) == 'quota' ? 'active' : '' }}"
                            href="{{ route('quota.index') }}">Quota</a>
                    </li>
                @endcan
                @can('Grade list')
                    <li>
                        <a class="treeview-item {{ Request::segment(1) == 'grade' ? 'active' : '' }}"
                            href="{{ route('grade.index') }}">Grade</a>
                    </li>
                @endcan
                @can('Office list')
                    <li>
                        <a class="treeview-item {{ Request::segment(1) == 'office' ? 'active' : '' }}"
                            href="{{ route('office.index') }}">Office</a>
                    </li>
                @endcan
                @can('Subject list')
                    <li>
                        <a class="treeview-item {{ Request::segment(1) == 'subject' ? 'active' : '' }}"
                            href="{{ route('subject.index') }}">Subject</a>
                    </li>
                @endcan
                @can('Institute list')
                    <li>
                        <a class="treeview-item {{ Request::segment(1) == 'institute' ? 'active' : '' }}"
                            href="{{ route('institute.index') }}">Institute</a>
                    </li>
                @endcan
                @can('Batch list')
                    <li>
                        <a class="treeview-item {{ Request::segment(1) == 'batch' ? 'active' : '' }}"
                            href="{{ route('batch.index') }}">Batch</a>
                    </li>
                @endcan
                {{--                @can('Organization list') --}}
                <li>
                    <a class="treeview-item {{ Request::segment(1) == 'organization' ? 'active' : '' }}"
                        href="{{ route('organization.index') }}">Organization</a>
                </li>
                {{--                @endcan --}}

                {{--                @can('Location list') --}}
                <li>
                    <a class="treeview-item {{ Request::segment(1) == 'location' ? 'active' : '' }}"
                        href="{{ route('location.index') }}">Location</a>
                </li>
                {{--                @endcan --}}
                {{--                @can('Sub-Location list') --}}
                <li>
                    <a class="treeview-item {{ Request::segment(1) == 'sub-location' ? 'active' : '' }}"
                        href="{{ route('sub-location.index') }}">Sub-Location</a>
                </li>
                {{--                @endcan --}}
                {{--                @can('Disease list') --}}
                <li>
                    <a class="treeview-item {{ Request::segment(1) == 'disease' ? 'active' : '' }}"
                        href="{{ route('disease.index') }}">Disease</a>
                </li>
                {{--                @endcan --}}
                @can('Action list')
                    <li>
                        <a class="treeview-item {{ Request::segment(1) == 'action' ? 'active' : '' }}"
                            href="{{ route('action.index') }}">Action</a>
                    </li>
                @endcan
            </ul>
        </li>
    @endcan


    <li class="treeview {{ Request::segment(2) == 'user' || Request::segment(2) == 'role' ? 'is-expanded' : '' }}">
        <a class="app-menu__item" href="#" data-toggle="treeview">
            <i class="app-menu__icon fa fa-laptop"></i>
            <span class="app-menu__label">Payroll</span>
            <i class="treeview-indicator fa fa-angle-right"></i></a>
        <ul class="treeview-menu">
            <li>
                <a class="treeview-item {{ Request::segment(2) == 'user' ? 'active' : '' }}"
                    href="{{ route('payroll.salary-template') }}">
                    <i class="icon fa fa-user-o"></i>Salary Template
                </a>
            </li>
            <li>
                <a class="treeview-item {{ Request::segment(2) == 'role' ? 'active' : '' }}"
                    href="{{ route('payroll.hourly-rate') }}">
                    <i class="icon fa fa-arrows-alt"></i>Hourly Template
                </a>
            </li>
            <li>
                <a class="treeview-item {{ Request::segment(2) == 'permission' ? 'active' : '' }}"
                    href="{{ route('payroll.manage-salary') }}">
                    <i class="icon fa fa-circle-o"></i>Manage Salary
                </a>
            </li>

            <li>
                <a class="treeview-item {{ Request::segment(2) == 'user' ? 'active' : '' }}"
                    href="{{ route('payroll.salary-list') }}">
                    <i class="icon fa fa-user-o"></i>Employee Salary List
                </a>
            </li>
            <li>
                <a class="treeview-item {{ Request::segment(2) == 'role' ? 'active' : '' }}"
                    href="{{ route('payroll.make-payment') }}">
                    <i class="icon fa fa-arrows-alt"></i>Make Payment
                </a>
            </li>

            {{-- <li>
                <a class="treeview-item {{ Request::segment(2) == 'role' ? 'active' : '' }}"
                    href="{{ route('welfare.create') }}">
                    <i class="icon fa fa-arrows-alt"></i>Welfare Fund
                </a>
            </li>
            <li>
                <a class="treeview-item {{ Request::segment(2) == 'permission' ? 'active' : '' }}" href="#">
                    <i class="icon fa fa-circle-o"></i>Generate Payslip
                </a>
            </li> --}}

            {{-- <li>
                <a class="treeview-item {{ Request::segment(2) == 'user' ? 'active' : '' }}"
                    href="{{ route('payroll.payroll-summary') }}">
                    <i class="icon fa fa-user-o"></i>Payroll Summary
                </a>
            </li>
            <li>
                <a class="treeview-item {{ Request::segment(2) == 'role' ? 'active' : '' }}"
                    href="{{ route('role.index') }}">
                    <i class="icon fa fa-arrows-alt"></i>Advance Salary
                </a>
            </li>
            <li>
                <a class="treeview-item {{ Request::segment(2) == 'permission' ? 'active' : '' }}"
                    href="{{ route('payroll.provident-fund') }}">
                    <i class="icon fa fa-circle-o"></i>Provident Fund
                </a>
            </li>
            <li>
                <a class="treeview-item {{ Request::segment(2) == 'role' ? 'active' : '' }}"
                    href="{{ route('role.index') }}">
                    <i class="icon fa fa-arrows-alt"></i>Overtime
                </a>
            </li>
            <li>
                <a class="treeview-item {{ Request::segment(2) == 'permission' ? 'active' : '' }}"
                    href="{{ route('permission.index') }}">
                    <i class="icon fa fa-circle-o"></i>Employee Award
                </a>
            </li>
            <li>
                <a class="treeview-item {{ Request::segment(2) == 'permission' ? 'active' : '' }}"
                    href="{{ route('permission.index') }}">
                    <i class="icon fa fa-circle-o"></i>Monthly Salary Bank Advice
                </a>
            </li> --}}
        </ul>
    </li>

    @can('Access control menu')
        <li class="treeview {{ Request::segment(2) == 'user' || Request::segment(2) == 'role' ? 'is-expanded' : '' }}">
            <a class="app-menu__item" href="#" data-toggle="treeview">
                <i class="app-menu__icon fa fa-laptop"></i>
                <span class="app-menu__label">Access Control</span>
                <i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
                @can('User list')
                    <li>
                        <a class="treeview-item {{ Request::segment(2) == 'user' ? 'active' : '' }}"
                            href="{{ route('user.index') }}">
                            <i class="icon fa fa-user-o"></i>Users
                        </a>
                    </li>
                @endcan
                @can('Role list')
                    <li>
                        <a class="treeview-item {{ Request::segment(2) == 'role' ? 'active' : '' }}"
                            href="{{ route('role.index') }}">
                            <i class="icon fa fa-arrows-alt"></i>Role
                        </a>
                    </li>
                @endcan
                @can('Permission list')
                    <li>
                        <a class="treeview-item {{ Request::segment(2) == 'permission' ? 'active' : '' }}"
                            href="{{ route('permission.index') }}">
                            <i class="icon fa fa-circle-o"></i>Permission
                        </a>
                    </li>
                @endcan
            </ul>
        </li>
    @endcan

    @can('Activity log menu')
        <li
            class="treeview {{ Route::currentRouteName() == 'login-activity' || Route::currentRouteName() == 'admin-activity' ? 'is-expanded' : '' }}">
            <a class="app-menu__item" href="#" data-toggle="treeview">
                <i class="app-menu__icon fa fa-laptop"></i>
                <span class="app-menu__label">Activity Log</span>
                <i class="treeview-indicator fa fa-angle-right"></i>
            </a>
            <ul class="treeview-menu">
                @can('Login activity list')
                    <li>
                        <a class="treeview-item {{ Route::currentRouteName() == 'login-activity' ? 'active' : '' }}"
                            href="{{ route('login-activity') }}"><i class="icon fa fa-eye-slash"></i>Login Activity</a>
                    </li>
                @endcan
                @can('Admin activity list')
                    <li>
                        <a class="treeview-item {{ Route::currentRouteName() == 'admin-activity' ? 'active' : '' }}"
                            href="{{ route('admin-activity') }}"><i class="icon fa fa-user-secret"></i>Admin Activity</a>
                    </li>
                @endcan
            </ul>
        </li>
    @endcan
    <li class="treeview {{ Request::segment(2) == 'user' || Request::segment(2) == 'role' ? 'is-expanded' : '' }}">
        <a class="app-menu__item" href="#" data-toggle="treeview">
            <i class="app-menu__icon fa fa-laptop"></i>
            <span class="app-menu__label">Dynamic Content</span>
            <i class="treeview-indicator fa fa-angle-right"></i></a>
        <ul class="treeview-menu">
            <li>
                <a class="treeview-item {{ Request::segment(1) == 'employee' ? '' : 'active' }}"
                    href="{{ route('brand.create') }}">
                    <i class="app-menu__icon fa fa-user"></i>
                    <span class="app-menu__label">Branding</span>
                </a>
            </li>
            <li>
                <a class="treeview-item {{ Request::segment(1) == 'employee' ? '' : 'active' }}"
                    href="{{ route('brand-name.create') }}">
                    <i class="app-menu__icon fa fa-user"></i>
                    <span class="app-menu__label">Name</span>
                </a>
            </li>
        </ul>
    </li>
    {{-- <li>
        <a class="app-menu__item {{ Request::segment(1) == 'employee' ? '' : 'active' }}"
            href="{{ route('data.import.form') }}">
            <i class="app-menu__icon fa fa-user"></i>
            <span class="app-menu__label"> Data Import</span>
        </a>
    </li> --}}
</ul>
