# Initial Production Deployment Report – Seed of Hope Website

- **Project:** Seed of Hope Website
- **Repository:** FreeDev-Group/seed-of-hope-website
- **Hosting provider:** Hostinger
- **Deployment method:** GitHub Actions and FTPS
- **Mentor:** Samuel Bulangalizi
- **Deployment date:** 11 November 2026
- **Deployment execution:** Jonathan Bitingingwa
- **Documentation:** Josué Kamo
## 1. Opening the Deployment Documentation

The process started by opening the project in Visual Studio Code (VS Code) and accessing the deployment documentation file:

`docs/deployment.md`

This document served as the reference for understanding the hosting configuration, file-transfer requirements, GitHub secrets and deployment procedure.

The existing deployment guide provided by the team was used to organize and document the operations performed during the installation.

## 2. Accessing the Hostinger Account

The next step was to access the Hostinger account using the provided username and password.

After authentication, the browser redirected us to the Hostinger control panel, known as **hPanel**.

This interface provides access to the hosting environment and the tools required to manage the website and its files.

The Hostinger environment was used as the destination for the website deployment.

## 3. Accessing the Project Through Visual Studio Code (SFTP)

After accessing Hostinger, we returned to Visual Studio Code to prepare the project file transfer.

Since several file-transfer protocols were available, we used the SFTP configuration file:

`.vscode/sftp.json`

This file was opened to inspect the connection settings used by the SFTP extension.

### 3.1. Downloading the project

In Visual Studio Code, we used the command:

`SFTP: Download Project`

This operation initiated the retrieval of the project files through the configured SFTP connection.

The transfer was performed through the VS Code terminal. Once the operation had completed successfully, the transferred project folder was opened in Visual Studio Code.

This provided access to the project files in the local development environment.

**Security note:** Connection credentials contained in `sftp.json` must remain private. Passwords and other sensitive connection information must never be committed to the public GitHub repository.

## 4. Connecting GitHub to the Hosting Environment

After preparing the project files, we proceeded to configure the connection required for automated deployment.

The configuration was performed in the GitHub repository:

`FreeDev-Group/seed-of-hope-website`

We accessed:

`Repository → Settings → Secrets and variables → Actions`

This section allows the management of sensitive credentials and non-sensitive configuration values used by GitHub Actions workflows.

### 4.1. Understanding GitHub Secrets and Variables

GitHub provides different configuration storage options:

- **Repository secrets:** encrypted sensitive information available to authorized workflows within the repository.
- **Environment secrets:** encrypted sensitive information associated with a specific deployment environment.
- **Repository variables:** non-sensitive configuration values available at repository level.
- **Environment variables:** non-sensitive configuration values associated with a specific environment.

For this deployment, we used **Environment secrets** because the credentials were intended specifically for the production environment.

### 4.2. Creating the production environment secrets

We accessed the Environment secrets section and configured the four required FTP credentials under the existing `production` environment.

The following secrets were added:

| Secret name | Purpose |
|---|---|
| `FTP_HOST` | Hostinger FTP server hostname. |
| `FTP_USER` | FTP account username. |
| `FTP_PASSWORD` | FTP account password. |
| `FTP_PATH` | Remote directory containing the WordPress installation. |

After configuration, all four secrets appeared in the `production` environment.

The Repository secrets section showed no configured secrets, and no organization-level secrets were available to this repository.

The credentials were stored as encrypted GitHub secrets rather than being written into the project files.

## 5. Running the First Deployment Through GitHub Actions

Once the production environment secrets had been configured, we returned to the GitHub repository to execute the deployment workflow.

### 5.1. Selecting the deployment workflow

We accessed the **Actions** tab in the GitHub repository.

We then selected the deployment workflow and chose the `production` environment, which had been configured previously under GitHub environment settings.

### 5.2. Executing the workflow

The deployment workflow was launched using the production configuration.

GitHub Actions executed the deployment process using the configured environment secrets to establish the required connection to the hosting server.

### 5.3. Deployment result

The GitHub Actions execution completed successfully and displayed a green success status.

This indicated that the deployment workflow had finished without reporting a failed execution.

## 6. Verifying the Website Online

After the successful workflow execution, we opened the website in a web browser:

[https://seedofhopebukavu.org](https://seedofhopebukavu.org)

The website opened successfully online following the deployment.

This provided an initial confirmation that the production website was accessible after the deployment process.

Further visual checks on desktop and mobile devices are documented through the screenshots at the end of this guide.

## 7. Deployment Evidence and Screenshots

The following screenshots will be added to provide visual evidence of the operations performed during the deployment.

### 7.1. Hostinger access

*Screenshot 1: Accessing the deployment.md file documents.*
<img width="1366" height="768" alt="git" src="https://github.com/user-attachments/assets/591ec91b-233c-4325-ab8c-95ec281876c3" />

### 7.2. SFTP configuration and project retrieval

*Screenshot 2: Opening the `.vscode/sftp.json` configuration file.*
<img width="1920" height="1080" alt="Screenshot (544)" src="https://github.com/user-attachments/assets/ac33b822-93e0-48e2-83e2-ac2966163144" />


*Screenshot 3: Successful project-folder transfer and opening in VS Code.*
<img width="1920" height="1080" alt="Screenshot (545)" src="https://github.com/user-attachments/assets/f9f8eeba-04b6-4fab-8993-2c0242385d1a" />

### 7.3. GitHub environment secrets

*Screenshot 4: Accessing Settings → Secrets and variables → Actions.*
<img width="1366" height="728" alt="pt" src="https://github.com/user-attachments/assets/1c5311dd-4ca5-4d28-aeb5-bde39746eb09" />

*Screenshot 5: The four configured Environment secrets under `production`.*
<img width="1366" height="768" alt="pob" src="https://github.com/user-attachments/assets/7ce0a846-4898-45df-be36-f4d06fbd9a23" />

### 7.4. GitHub Actions deployment

*Screenshot 6: Selecting the deployment workflow and production environment.*
<img width="1366" height="768" alt="KIT" src="https://github.com/user-attachments/assets/a3972b95-a89c-4fbb-a632-b0f4bab5c029" />

*Screenshot 7: Successful GitHub Actions execution displaying the green status.*
<img width="1366" height="768" alt="ACT" src="https://github.com/user-attachments/assets/10211fe9-5a70-4075-bff4-4f0c62ca3d6b" />

### 7.5. Website online

*Screenshot 8: Seed of Hope website successfully opened at `seedofhopebukavu.org`.*
<img width="1920" height="1080" alt="Screenshot (537)" src="https://github.com/user-attachments/assets/106f5f2e-720f-413e-853b-54d5484b33b6" />



---

**Documentation status:** The initial deployment process has been documented based on the operations performed. Additional configuration details, WordPress theme and plugin activation, backup verification and handover procedures will be documented as they are confirmed.
