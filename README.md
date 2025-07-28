# 🧺 Doctor Appointment Scheduler

A full-stack web application designed to streamline doctor appointment scheduling in clinics. It enables patients to book, manage, and track appointments online, while giving administrators complete control over clinic scheduling workflows.

---

## 📌 Overview

Traditional clinic appointment systems rely on walk-ins or phone calls—often resulting in time conflicts, inefficiencies, and long queues. This Doctor Appointment Scheduler digitizes the entire process, offering an intuitive and secure web platform for both patients and administrators.

---

## 🚀 Features

### 👤 Patient

* Register and manage profile
* Secure login and logout
* View available doctors and time slots
* Book, view, and cancel appointments

### 🛠️ Admin

* Secure login
* Monitor all appointments
* Approve, cancel, or mark appointments as completed
* View and manage patient details

### 🌐 System-Wide

* Time slot validation to prevent double-booking
* Session-based authentication and role-based access
* Clean UI with responsive design
* Secure password hashing and form validation

---

## 🧰 Tech Stack

| Component       | Technology             |
| --------------- | ---------------------- |
| Frontend        | HTML, CSS              |
| Backend         | PHP                    |
| Database        | MySQL                  |
| Server          | XAMPP (Apache + MySQL) |
| Version Control | Git, GitHub            |

---

## 🧱 Database Design

### 🔗 Entity Relationship

* **Entities**: `Patient`, `Doctor`, `Appointment`
* One-to-many relationships:

  * A patient can have multiple appointments
  * Each appointment is linked to one doctor

### 📘 Schema Tables

* `patients`
* `doctors`
* `appointments`
* `admins`
* `doctor_schedule`

Designed using normalized schema with primary and foreign key constraints for data integrity.

---

## 💽 UI Snapshots (Add Screenshots Here)

* Home Page
* Patient Registration & Login
* Appointment Booking Form
* Patient Dashboard
* Admin Dashboard
* phpMyAdmin database structure

👉 *You can place screenshots inside a `screenshots/` folder and link them here for better presentation.*

---

## ✅ Functional Requirements

### Patient

* Register and login
* Browse doctors and available slots
* Book and cancel appointments

### Admin

* View and manage all appointments
* Approve/cancel/complete bookings
* Access patient info

### System-wide

* Time slot conflict handling
* Authentication and session control
* CRUD operations on all entities

---

## 📀 Non-Functional Requirements

* **Usability**: Clean and responsive interface for all screen sizes
* **Security**: Password hashing, session-based access, role separation
* **Performance**: Optimized queries and schema design
* **Scalability**: Modular and maintainable codebase for future expansion
* **Compatibility**: Works on all major browsers (Chrome, Firefox, Edge, Safari)

---

## 🔮 Future Enhancements

* 🧑‍⚕️ Doctor login and self-scheduling interface
* 📩 Email/SMS notifications for appointments
* 📱 Mobile app version using Flutter or React Native
* 💳 Payment gateway integration (e.g., GPay, Paytm)
* 📊 Analytics and reporting dashboard for admin

---

## 💡 How to Run Locally

1. Clone the repository:

   ```bash
   git clone https://github.com/yourusername/DoctorAppointmentScheduler.git
   ```
2. Place the folder inside your `C:\xampp\htdocs\` directory.
3. Start **XAMPP**, enable **Apache** and **MySQL**.
4. Import the database SQL file (if available) via **phpMyAdmin**.
5. Open your browser and go to:

   ```
   http://localhost/DoctorAppointmentScheduler
   ```

---

## 📚 References

* [PHP Documentation](https://www.php.net/docs.php)
* [MySQL Documentation](https://dev.mysql.com/doc/)
* [W3Schools](https://www.w3schools.com/)
* [GeeksforGeeks](https://www.geeksforgeeks.org/)
* [MDN Web Docs](https://developer.mozilla.org/)

---

## 📝 License & Credits

This project is developed and maintained by **Varun Kumar S**.

You are free to use and modify this project **for learning or academic purposes only**.

> ⚠️ **Please do not misuse, plagiarize, or re-upload this project elsewhere without proper credit.**
> Sharing or repurposing it commercially without permission is strictly discouraged.

If you use or build upon this project, a mention or link to this repository is appreciated.

---
