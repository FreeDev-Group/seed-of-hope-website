

# Initial Production Deployment Report – Seed of Hope Website

- **Project:** Seed of Hope Website
- **Repository:** FreeDev-Group/seed-of-hope-website
- **Hosting provider:** Hostinger
- **Deployment method:** GitHub Actions and FTPS
- **Mentor:** Samuel1s
- **Deployment date:** 10 November 2026
- **Deployment execution:** Bitingingwa
- **Documentation:** kamojose09-blip

## 1. Opening the Deployment Documentation

The process started by opening the project in Visual Studio Code (VS Code) and accessing the deployment documentation file:

`docs/deploiement.md`

This document served as the reference for understanding the hosting configuration, file-transfer requirements, GitHub secrets and deployment procedure.

The existing deployment guide provided by the team was used to organize and document the operations performed during the initial production deployment.

## 2. Accessing the Hostinger Account

The next step was to access the Hostinger account using the provided credentials.

After authentication, the browser redirected us to the Hostinger control panel, known as **hPanel**.

This interface provides access to the hosting environment and the tools required to manage the website and its files.

The Hostinger environment was used as the destination for the website deployment.

## 3. Verifying FTP Access Through Visual Studio Code

Before configuring the automated deployment, we verified that the dedicated FTP account could connect to the Hostinger server.

The connection settings were available in the following configuration file:

`.vscode/sftp.json`

This file was inspected to understand the connection configuration used by the VS Code SFTP extension.

The purpose of this operation was strictly to verify access to the remote server and confirm that its files could be listed.

**Important security note:** This access test must only list the remote files. Server files must never be downloaded to a local computer during this verification. In particular, `wp-config.php` contains sensitive database credentials. Any local copy of server files created during an earlier test must be deleted. FTP credentials must also remain private and must never be committed to the public GitHub repository.

This connection test was separate from the actual deployment process. The production deployment was performed through GitHub Actions.

## 4. Connecting GitHub to the Hosting Environment

After verifying the FTP connection, we proceeded to configure the connection required for automated deployment.

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
- **Environment variables:** non-sensitive configuration values associated with a specific deployment environment.

For this deployment, we used **Environment secrets** for the production FTP credentials because they were intended specifically for the production environment.

We also used environment variables for additional deployment configuration.

### 4.2. Configuring the production environment

We accessed the existing `production` environment and configured the required FTP credentials.

The following secrets were used:

| Secret name | Purpose |
|---|---|
| `FTP_HOST` | Hostinger FTP server hostname. |
| `FTP_USER` | Dedicated FTP account username. |
| `FTP_PASSWORD` | FTP account password. |
| `FTP_PATH` | Remote directory used for deployment. |

The following environment variables were also configured:

| Variable name | Purpose |
|---|---|
| `FTP_VERIFY_CERT` | Controls FTP certificate verification. |
| `WP_URL` | Provides the website URL used by the deployment smoke test. |

The credentials were stored as encrypted GitHub environment secrets rather than being written directly into the project files.

The configuration was associated with the `production` environment so that the deployment workflow could use the required values when executing the production deployment.

## 5. Running the First Production Deployment Through GitHub Actions

Once the production configuration had been prepared, we returned to the GitHub repository to execute the deployment workflow.

### 5.1. Selecting the deployment workflow

We accessed the **Actions** tab in the GitHub repository.

We then selected the deployment workflow and chose the `production` environment, which had been configured previously under GitHub environment settings.

### 5.2. Deployment preparation and execution order

The deployment followed this sequence:

1. **Backup:** a backup was performed before making production changes.
2. **Dry run:** the deployment process was tested without carrying out the actual production transfer.
3. **Approval:** Samuel reviewed and approved the deployment before the real execution.
4. **Real deployment:** the deployment workflow was executed against the production environment.
5. **Activation:** the Seed of Hope theme and the Seed of Hope Core plugin were activated through `wp-admin`.
6. **Cache purge:** the website cache was cleared after activation.

### 5.3. Deployment result

GitHub Actions executed the deployment workflow using the configured environment secrets and variables to establish the required connection to the hosting server.

The execution completed successfully and displayed a green success status.

This indicated that the deployment workflow had finished without reporting a failed execution.

## 6. Lessons Learned During the Deployment

The initial production deployment helped identify several important details about the Hostinger environment and the GitHub Actions configuration.

### 6.1. FTP account root directory

The dedicated deployment FTP account had access only to the `public_html` directory.

For this reason, the FTP account's root directory was `/`, rather than the full server path beginning with `/home/...`.

Using a path such as `/home/...` resulted in a `No such file or directory` error because that location was outside the directory exposed to the FTP account.

### 6.2. Hostinger FTP certificate verification

Hostinger's FTP certificate was issued for the `*.hstgr.io` domain pattern.

This caused a certificate verification issue during the deployment connection.

As a temporary workaround, the environment variable `FTP_VERIFY_CERT` was configured with the value `no`.

This setting was used to allow the deployment connection to proceed despite the certificate verification mismatch. It should be reviewed later in favour of a properly verified certificate configuration.

### 6.3. Correct FTP deployment path

The correct value for `FTP_PATH` was `/`, not `.`.

Using `.` caused an issue because GitHub Actions masked the dots in the secret value in its logs, making the displayed output difficult to interpret.

Configuring the path as `/` resolved this configuration issue.

### 6.4. Website URL used by the smoke test

The `WP_URL` environment variable was used by the deployment smoke test.

It provides the website URL that the workflow checks after deployment to verify that the production website responds as expected.

### 6.5. Importance of the deployment sequence

The deployment also demonstrated the importance of following an approved sequence:

**Backup → Dry run → Samuel's approval → Real deployment → Activation in wp-admin → Cache purge.**

Following this order helps reduce deployment risks and ensures that production changes are made only after the necessary checks and approval.

## 7. Verifying the Website Online

After the successful workflow execution and the activation of the Seed of Hope theme, we opened the public website in a web browser:

[https://seedofhopebukavu.org](https://seedofhopebukavu.org)

The website opened successfully online following the deployment.

The public homepage was then used to verify that the Seed of Hope website was accessible with the intended theme activated.

Further visual checks on desktop and mobile devices can be documented separately as they are completed.

## 8. Deployment Evidence and Screenshots

The following screenshots provide visual evidence of the main operations performed during the initial production deployment.

Before adding screenshots to this public repository, all sensitive information must be removed or obscured. Screenshots must not expose FTP credentials, server paths, meeting codes, private conversations or personal faces.

*Deployment documentation*

<img width="1366" height="768" alt="git" src="https://github.com/user-attachments/assets/591ec91b-233c-4325-ab8c-95ec281876c3" />

*Accessing Settings.*

<img width="806" height="475" alt="action" src="https://github.com/user-attachments/assets/c944459b-85d5-4fbc-9876-7c9edc51f04f" />

*Selecting the deploiement workflow and production environnement*
<img width="1366" height="768" alt="KIT" src="https://github.com/user-attachments/assets/642a67ea-967b-4f6f-89b1-fba58a5f2c40" />

*Successful GitHub Actions execution displaying the green success status.*
<img width="1366" height="768" alt="ACT" src="https://github.com/user-attachments/assets/3e0e0434-442a-44f7-b796-e558ab35681b" />

*Public Seed of Hope homepage displaying the activated Seed of Hope theme.*

<img width="1366" height="768" alt="wpn" src="https://github.com/user-attachments/assets/2a6ff223-c4a3-4c00-93f0-4aa0641744a0" />


**Documentation status:** The initial production deployment process has been documented, including the FTP access verification, GitHub production configuration, deployment sequence, technical lessons learned and initial website verification. The original team deployment guide remains in `docs/deploiement.md`, while this report is maintained separately in `docs/initial-production-deployment.md`.
