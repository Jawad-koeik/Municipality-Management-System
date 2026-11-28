
>
> Define **what** the Minimum Viable Product (MVP) must deliver, **who** it serves, and **how its success will be verified**. This document describes product requirements, not the technical implementation.

---

## Document Control

| Field | Team response |
| --- | --- |
| Project name | Municipality Management System (MMS) |
| Development track | Laravel (PHP) — Web-based Application |
| Team leader | Jad Assaf |
| Team members | • Jawad Koeik Hamza Hussein Hadi shehab Jad Assaf Sarah mazeh Ghadeer ghaith 
/ Supervised by: Dr. Ali Ghorayeb (SRS Author) |
| PRD version | 1.0 |
| Last updated | 27-11-2026 |
| Source SRS document | `Municipality Management System - SRS (Laravel)` (Version 1.0, November 2026) |
| Discovery & Validation document | Not yet validated (derived from SRS v1.0) |
| Review status | Draft |

> **Executive summary (2–3 sentences):** The Municipality Management System (MMS) streamlines administrative, operational, and citizen-related processes within Lebanese municipalities. It provides a centralized platform for citizen services, permits and licensing, finance and billing, urban planning and projects, human resources, events and public notices, and reporting dashboards. By replacing fragmented manual workflows with tracked digital processes, MMS improves municipal efficiency, transparency, and communication with citizens.

---

## 1. Problem & Target Users

### 1.1 Problem Statement

Lebanese municipalities handle a wide range of citizen-facing and internal administrative operations—including civil certificate requests, public service complaints, business and construction permits, property tax and utility billing, infrastructure projects, and staff management—often through disconnected, manual, or paper-based processes. Citizens lack visibility into the status of their submitted requests and permits, frequently having to visit municipal offices in person to follow up or settle fees. Meanwhile, municipal departments struggle to coordinate approvals, track project expenditures, manage employee attendance and payroll, and produce timely financial and operational reports.

### 1.2 Primary User

- **Primary user / role:** Municipal Staff & Administration (Admin / Mayor / Municipal Director, Clerks, Finance Officers, Urban Planners, and HR Managers).
- **Relevant context:** They use the centralized platform during daily municipal operations across departments and branches to process citizen requests, issue permits, manage billing and budgets, oversee urban projects, and administer staff records.
- **Primary need:** A unified, role-based system to manage workflows, approvals, records, and reporting across all municipal departments while keeping citizens informed.

**Secondary users:**
- **Citizens / Residents:** Register and manage their profiles, submit online requests for certificates and municipal services, apply for permits, track request and permit statuses, view public notices/events, and pay municipal bills online.

### 1.3 Evidence From Discovery

*Note: Formal field interviews are **Not yet validated**; the findings below are grounded in the approved SRS (v1.0) for Lebanese municipalities.*

| Finding | Evidence or source | Implication for the MVP |
| --- | --- | --- |
| Citizen certificate and service requests (residency, birth, death, marriage, garbage collection, street repair, complaints) lack centralized tracking and automated status updates. | SRS Section 1 & Section 2.A | Prioritize a Citizen Services portal with online submission, unique tracking, audit trail, and email/SMS status notifications. |
| Permit issuance (business, construction, vehicle, public events) and municipal billing (property tax, utility fees) involve multi-step reviews and manual receipting. | SRS Section 2.B & Section 2.C | Provide structured application-to-approval workflows for permits, alongside tax/utility billing, online payment tracking, and receipt generation. |
| Municipal leadership and department heads need cross-departmental visibility over projects, staff attendance/payroll, and financial summaries. | SRS Section 2.D, 2.E, 2.G | Include role-based dashboards, project/task tracking, HR attendance/payroll modules, and PDF/Excel report exports. |

---

## 2. MVP Goal & Product Outcome

### 2.1 One-Sentence Goal

> Our MVP enables **Lebanese municipal staff and citizens** to submit, process, approve, and track citizen service requests, permits, municipal payments, urban projects, and internal operations through one centralized, role-based platform.

### 2.2 Expected User Outcome

Citizens can register, submit certificate or service requests and permit applications online, pay municipal taxes and utility bills with downloadable receipts, and track the real-time status of their submissions via portal updates and notifications. Municipal staff, department managers, and the Mayor/Director can review and process requests within their assigned roles, manage budgets and infrastructure projects, administer employee attendance and payroll, publish public notices, and export analytical reports.

### 2.3 Success Indicator

| Metric / indicator | How it will be measured | Target or pass condition |
| --- | --- | --- |
| End-to-end citizen request & permit lifecycle | Test a citizen submitting a certificate/service request and permit application through clerk review, approval, and completion. | 100% of test requests and permits complete the defined workflow with accurate status updates and audit history. |
| Finance, billing & receipt accuracy | Test property tax/utility payment recording, receipt generation, and financial summary reporting. | 100% of test payments generate accurate receipts and reflect correctly in financial summaries. |
| Role-based access & data isolation | Test each of the 6 roles (Admin/Mayor, Finance Officer, Urban Planner, HR Manager, Clerk, Citizen) against authorized and restricted actions. | 100% of authorized actions succeed and 100% of unauthorized or cross-citizen access attempts are blocked. |
| Multi-module operational coverage | Verify core workflows across Citizen Services, Permits, Finance, Projects/Tasks, HR/Attendance, Events, and PDF/Excel Reports. | All 7 SRS modules operate without blocking errors and pass functional acceptance checks. |

*This indicator agrees with the end-to-end acceptance test in Section 6.*

---

## 3. Core User Journey

**Scenario:** A resident uses MMS to request an official certificate, pay an associated municipal fee, and track the request until completion, while municipal staff process and approve it.

1. **Starting point:** A citizen needs a residency certificate and has an active municipal property/utility bill to settle.
2. **First action:** The citizen registers or logs into the Citizen Portal, verifies their profile details (national ID, address, contact), and selects the online certificate request form.
3. **System response:** The system validates the required information, creates the request with an initial status, and displays it in the citizen's tracking dashboard.
4. **Core action:** A Municipal Clerk reviews the incoming request, verifies citizen eligibility, and updates the status; if a fee applies, the Finance Officer records or verifies the online payment and issues a payment receipt.
5. **System outcome:** The system logs each status transition, sends a status notification (email/SMS) to the citizen, and updates the admin/department dashboards.
6. **Completion:** The citizen views the completed status, downloads the receipt/document, and no longer needs to visit the municipality for status inquiries.

### Alternative & Failure Paths

| Situation | Expected product behavior |
| --- | --- |
| Required citizen or request fields are missing on submission. | The system highlights missing fields and prevents incomplete submission without creating duplicate records. |
| A citizen attempts to view another citizen's requests, permits, or payment records. | The system denies access and does not expose any other citizen's personal or financial data. |
| An online payment fails or is declined by the payment gateway. | The system keeps the bill unpaid, records the failed attempt, displays a clear error message, and allows the citizen to retry. |
| A staff member attempts an action outside their role (e.g., a Clerk attempting to modify HR payroll or system-wide budgets). | The system blocks the action and displays an authorization error. |
| External SMS/email notification delivery is temporarily unavailable. | The core request, permit, or payment state change still succeeds and is visible in the portal; the notification failure is logged for retry. |

---

## 4. Functional Requirements

**R1 — Citizen Services & Request Management**

- **Priority:** Must-have
- **User story:** As a citizen, I want to manage my profile and submit online requests for certificates (residency, birth, death, marriage) and municipal services (garbage collection, street repair, public complaints), so that I can track their progress without visiting municipal offices.
- **Expected behavior:** Citizens can register, maintain their profile (national ID, address, contact, date of birth), submit service/certificate requests, and track request statuses from submission to completion. Clerks and Admins can search citizen records, process requests, update statuses, and maintain an audit trail, triggering email/SMS notifications on status changes.
- **Acceptance criteria:**
  - **Given** a registered citizen, **when** they submit a certificate or service request with all required fields, **then** the system saves the request with a submission date and initial status and displays it in their tracking list.
  - **Given** a Clerk or Admin updates a request status, **when** the update is saved, **then** the updated status and completion date (if completed) are visible to the citizen and a notification is queued.
  - **Given** required fields are missing, **when** a citizen submits a request, **then** the system prevents submission and displays validation errors.

**R2 — Permits & Licensing Workflow**

- **Priority:** Must-have
- **User story:** As a citizen or business owner, I want to apply for business, construction, vehicle, or public event permits online and track their review, so that I can obtain and renew permits transparently.
- **Expected behavior:** Applicants can submit permit applications with supporting documents. Authorized Clerks and Admins can review applications, approve or reject them, set issue and expiry dates, and manage renewals.
- **Acceptance criteria:**
  - **Given** an applicant submits a permit application with required documents, **when** the form is submitted, **then** the system creates a permit record in pending review status.
  - **Given** an authorized staff member approves a permit, **when** the approval is saved, **then** the system updates the status to approved and records the issue and expiry dates.
  - **Given** an unauthorized user attempts to approve or issue a permit, **when** the action is triggered, **then** the system denies the request.

**R3 — Finance, Billing & Payment Tracking**

- **Priority:** Must-have
- **User story:** As a citizen, I want to view and pay my property taxes and utility bills (water, electricity, waste management) online and receive receipts, so that I can settle municipal dues conveniently; and as a Finance Officer, I want to manage billing, payments, and municipal budgets.
- **Expected behavior:** Finance Officers can manage property tax assessments, utility bills, and municipal budgets, and generate financial reports. Citizens can pay bills online or have payments recorded, view payment history, and download receipts.
- **Acceptance criteria:**
  - **Given** an unpaid municipal bill or tax record, **when** a payment is completed or recorded by a Finance Officer, **then** the system updates the payment status, generates a receipt, and adds it to payment history.
  - **Given** a Finance Officer opens financial reporting, **when** they filter by period or payment type, **then** the system displays accurate summaries of taxes, payments, and expenses.

**R4 — Urban Planning & Municipal Projects**

- **Priority:** Must-have
- **User story:** As an Urban Planner or Project Manager, I want to create and track municipal infrastructure projects (roads, parks, public buildings), assign tasks and budgets, and archive project documents, so that municipal projects stay on schedule and within budget.
- **Expected behavior:** Urban Planners and Admins can create projects linked to departments with budgets, start/end dates, and statuses; assign tasks to staff with timelines; monitor progress and expenditures; and upload/archive project documents.
- **Acceptance criteria:**
  - **Given** an Urban Planner creates a project with a budget and timeline, **when** tasks are assigned to staff, **then** assignees and managers can track task statuses and project progress.
  - **Given** a project document is uploaded, **when** it is saved, **then** it is linked to the project in the document repository with uploader metadata.

**R5 — Human Resources & Staff Management**

- **Priority:** Must-have
- **User story:** As an HR Manager, I want to manage employee profiles, departments, attendance, leave approvals, and payroll, so that municipal staffing and compensation are accurately administered.
- **Expected behavior:** HR Managers can maintain employee records (position, department, hire date, salary), record and review daily attendance (check-in, check-out, hours worked) and leave requests, and process payroll with deductions and bonuses.
- **Acceptance criteria:**
  - **Given** an employee checks in and out for a workday, **when** attendance is recorded, **then** the system calculates and stores hours worked for that date.
  - **Given** an HR Manager processes payroll, **when** deductions and bonuses are applied, **then** the system calculates net compensation accurately and restricts access to HR/Admin roles.

**R6 — Events, Public Notices & Reporting Dashboards**

- **Priority:** Should-have / Must-have (Core SRS Modules F & G)
- **User story:** As a municipal administrator, I want to publish community events and public announcements and view cross-module dashboards with PDF/Excel exports, so that citizens stay informed and leadership can make data-driven decisions.
- **Expected behavior:** Admins can publish events and civic announcements targeted to specific citizen groups or staff departments on a calendar view. Role-specific dashboards display analytics for citizen requests, finances, projects, and staff performance, with PDF/Excel export and scheduled report emailing.
- **Acceptance criteria:**
  - **Given** an Admin publishes an event or public notice with a target audience, **when** it is saved, **then** it appears on the events calendar and triggers targeted notifications.
  - **Given** an authorized user views a dashboard (Admin, Finance, HR, or Projects), **when** they export a report, **then** the system generates a downloadable PDF or Excel file matching the displayed data.

**R7 — Authentication, Multi-Department Support & Role-Based Access Control (RBAC)**

- **Priority:** Must-have
- **User story:** As a system user, I want to sign in securely and only access features and data permitted for my municipal role and department, so that sensitive citizen, financial, and HR records remain protected.
- **Expected behavior:** The system supports secure registration/login (with optional SSO), multi-branch/department assignment, and strict RBAC across the six defined roles: Admin/Mayor/Municipal Director, Finance Officer, Urban Planner/Project Manager, HR Manager, Clerk/Staff, and Citizen/Resident. Public registration must assign the Citizen role by default.
- **Acceptance criteria:**
  - **Given** a new user registers publicly, **when** the account is created, **then** the system assigns the Citizen/Resident role and denies self-assignment of staff or admin roles.
  - **Given** a user attempts to access an endpoint or screen outside their role permissions, **when** the request is made, **then** the system denies access.

---

## 5. MVP Scope, Boundaries & Product Rules

### 5.1 In Scope

- **Arabic (RTL) primary user interface** tailored for Lebanese citizens and municipal staff.
- Multi-department / multi-branch municipal support with RBAC for all 6 defined roles.
- Citizen registration, profile management, certificate/service requests, status tracking, and **mocked** email/SMS notifications.
- Permits & licensing workflows (business, construction, vehicle, public events) with document uploads and renewal tracking.
- Finance & billing: property tax, utility billing, payment tracking, receipt generation, budget management, and **mocked** online payment processing.
- Urban planning & projects: project/task tracking, budgets, timelines, and document archiving.
- HR & staff management: employee profiles, attendance/timesheets, leave workflow, and payroll processing.
- Events & public notices calendar with targeted notifications.
- Role-based analytics dashboards and PDF/Excel report exports.

### 5.2 Explicitly Out of Scope

- Cross-municipality federation or multi-tenant SaaS billing across unrelated municipalities (single Lebanese municipality / multi-branch office model per SRS).
- Native iOS/Android mobile applications (web-based responsive application only).
- Automated AI legal/zoning adjudication without human municipal approval.
- Hardware biometric time-clock integration (attendance is recorded via the web platform).

### 5.3 Product Rules & Constraints

#### A. Product Rules

| Rule ID | Product Rule | Reason |
| --- | --- | --- |
| BR-01 | Public self-registration only creates Citizen/Resident accounts; staff and officer accounts must be provisioned by an Admin. | Prevent privilege escalation into municipal operations. |
| BR-02 | Citizens can only view and manage their own profile, requests, permits, and payments. | Protect citizen privacy and personal/financial records. |
| BR-03 | Permit approval, tax/utility billing adjustments, payroll processing, and project budget changes require the corresponding authorized role. | Enforce municipal governance and separation of duties. |
| BR-04 | Every status change on citizen requests and permits must record timestamps and responsible actors for auditability. | Ensure municipal transparency and accountability. |
| BR-05 | Supporting documents uploaded for permits, projects, or requests must be linked to their parent entity and uploader with version/audit metadata. | Maintain traceable municipal archives. |

#### B. Product Constraints

| Constraint ID | Product Constraint | Reason |
| --- | --- | --- |
| PC-01 | System must be delivered as a web-based application accessible on desktop and mobile browsers, with **Arabic (RTL)** as the primary UI language. | Specified in SRS Platform & UI requirements and confirmed for Lebanese municipal users. |
| PC-02 | System must support 99.9% availability, regular backups, and handling of thousands of citizen records. | Specified in SRS Section 5 Non-Functional Requirements. |
| PC-03 | Sensitive operations (payments, payroll, citizen PII) require encrypted transport (HTTPS) and password hashing. | Specified in SRS Section 5 Security requirements. |
| PC-04 | Payment gateway, SMS, and email notifications will be **mocked** in the MVP. | Confirmed MVP scope to validate end-to-end flows without live third-party gateway/SMS billing. |

---

## 6. End-to-End MVP Acceptance Test

| Item | Required description |
| --- | --- |
| Test name | Full Municipal Operations & Citizen Service Lifecycle |
| Related requirements | R1, R2, R3, R4, R5, R6, R7 |
| Test users / roles | Citizen A, Citizen B, Clerk A, Finance Officer A, Urban Planner A, HR Manager A, Admin A |
| Test data / initial state | Seeded departments, active citizen accounts (Citizen A, Citizen B), staff accounts for each role, and sample employee/project records. |
| Test actions | 1. Citizen A logs into the Citizen Portal and submits a residency certificate request.<br>2. Clerk A reviews and processes Citizen A's request, updating its status to completed.<br>3. Citizen A submits a business permit application with a supporting document; Clerk A/Admin A approves it and sets issue/expiry dates.<br>4. Finance Officer A records/verifies a property tax payment for Citizen A and generates a receipt.<br>5. Urban Planner A creates a road maintenance project with a budget and assigns a task.<br>6. HR Manager A records employee attendance and runs payroll.<br>7. Admin A publishes a public notice and exports a PDF/Excel summary report.<br>8. Citizen B attempts to access Citizen A's request and payment receipt directly. |
| Expected results | Steps 1–7 succeed with persisted records, accurate statuses, generated receipt, and exported report. Step 8 is rejected with an authorization/not-found error and zero data leakage. |
| Measurable pass condition | 100% of steps 1–7 complete as specified; 0 unauthorized cross-citizen or cross-role actions succeed. |
| Failure / abuse test | Citizen A attempts to access the HR Payroll screen or approve their own permit. Expected: access is denied and no state changes occur. |

### Test Procedure

1. **Setup:** Seed departments, roles, Citizen A, Citizen B, and one user per staff role.
2. **Citizen & Staff Workflows:** Execute steps 1–7 in order, verifying UI/response feedback and persisted state after each action.
3. **Security & Isolation Verification:** Execute step 8 and the abuse test (Citizen A attempting staff/admin actions), confirming all unauthorized attempts are blocked.

**Pass condition:** All core module journeys complete end-to-end, all audit fields (dates, statuses, actors) are recorded, and 100% of unauthorized access attempts fail safely.

---

## 7. Open Questions & Assumptions

**Confirmed MVP Decisions:**
- **UI Language:** Arabic (RTL) is confirmed as the primary interface language for all citizen and staff screens.
- **External Integrations:** Payment processing, SMS notifications, and email notifications will all be mocked in the MVP.

| Open question / assumption | Why it matters | How the team will resolve it |
| --- | --- | --- |
| What are the exact municipal fee schedules and tax calculation formulas per municipality size? (**Not yet validated**) | Needed to seed accurate default tax and permit fee rules. | Obtain sample municipal fee tables or use realistic Lebanese municipal defaults in seeders. |

---

## 8. Team Readiness Checklist

- [x] Our problem statement and primary user are grounded in the project SRS.
- [x] Our MVP has **a clearly defined end-to-end journey** and failure paths.
- [x] Essential requirements are prioritized with **testable acceptance criteria**.
- [x] The **in-scope** and **out-of-scope** lists are explicit and consistent.
- [x] Important product rules, privacy expectations, and failure cases are documented.
- [x] The main MVP acceptance test is **repeatable and measurable**.
- [x] Unvalidated assumptions and open questions are identified.
- [x] The PRD does not contain architecture, ER diagrams, database schemas, or API design (those are in `docs/TDD.md`).
- [ ] All team members have reviewed and approved the document.


