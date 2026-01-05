# Melodia Academy (A music school management website)
<br>
<hr>

# Figma Prototype 
###  [User View](https://www.figma.com/proto/IQByZ0OYtewrQ2wjUQVzzY/Fox-stocks-Dashboard--Community-?node-id=1119-227&p=f&t=xkwumrh95jitUA04-9&scaling=min-zoom&content-scaling=fixed&page-id=0%3A1&starting-point-node-id=1119%3A227&show-proto-sidebar=1)
###   [Instructor View](https://www.figma.com/proto/IQByZ0OYtewrQ2wjUQVzzY/Fox-stocks-Dashboard--Community-?node-id=1216-2026&p=f&t=xkwumrh95jitUA04-9&scaling=min-zoom&content-scaling=fixed&page-id=0%3A1&starting-point-node-id=1216%3A2026&show-proto-sidebar=1)
###   [Admin View](https://www.figma.com/proto/IQByZ0OYtewrQ2wjUQVzzY/Fox-stocks-Dashboard--Community-?node-id=1181-1663&p=f&t=xkwumrh95jitUA04-9&scaling=min-zoom&content-scaling=fixed&page-id=0%3A1&starting-point-node-id=1181%3A1663&show-proto-sidebar=1)

## Github [Link](https://github.com/jhasan2026/MelodiaAcademy)
## Database Schema [Link](https://www.figma.com/proto/SiqbRsGFGPEikIYbqqvVVm/Database-Diagram-Builder--Community-?node-id=11-376&p=f&t=XEeFG4Lfui0aLZDE-0&scaling=min-zoom&content-scaling=fixed&page-id=0%3A1&starting-point-node-id=11%3A376)


<hr>

# Documentation

<hr>
<hr>

## Controller

1. Course Controller
   - index: show all course [all]
   - show: a single course details [all]
   - create: course create [admin]
   - store: course into db [admin]
   - edit: course edit [admin]
   - update: course edit into db [admin]
   - delete: delete the course [admin]
   
2. Course Topic Controller
    - index
    - show
    - create: create course topic that will be learned 
    - store: store into db
    - edit
    - update
    - delete  
   
3. Course Comments Controller
    - index
    - show
    - create: create comment 
    - store: store into db
    - edit: edit comment
    - update: store db
    - delete: delete comment
   
4. Course Enroll Controller
    - index: my course - assigned course for me [student]
    - show
    - create: course enroll by the student - payment page [student]
    - store: enrollment same into db
    - edit
    - update
    - delete
    - enrol: confirmation by the admin - view
    - approve: if approve
    - reject: if reject
5. Session Controller

6. Register Controller

7. Profile Controller
    - index
    - show: user profile view [student, instructor]
    - create
    - store
    - edit: edit by the user
    - update: update by the user
    - delete

## Model

1. Course Model
   - **HasMany**
     - course_topic() [CourseTopic]
     - enrollment()  [CourseEnroll]
   - **Belongs to**
     - user() [User]
     
2. Course Topic Model
   - **HasMany**
   - **Belongs to**
     - course() [Course]
   
3. Course Enroll Model
    - **HasMany**
      - course()  [Course]
      - student()  [Student]
    - **Belongs to**
   
4. User Model
    - **HasOne**
      - student() [Student]
      - instructor() [Instructor]
    - **HasMany**
    - **Belongs to**
   
5. Student Model
   - **HasMany**
   - **Belongs to**
     - user() [User]
6. Instructor Model
   - **HasMany**
   - **Belongs to**
     - user() [User]


## View
1. courses
2. topic
3. course_enroll
4. auth
5. profile

## Route

<hr>

### Observer
1. User Observer

### Policy
1. Course Policy
2. Course Enroll Policy

### Factory
1. Course Factory
2. Course Topic Factory
3. Course Enroll Factory
4. User Factory
5. Student Factory
6. Student Factory

### Migration
### Seeder




