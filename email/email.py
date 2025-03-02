import smtplib
from email.mime.multipart import MIMEMultipart
from email.mime.text import MIMEText

# Gmail credentials (use App Password)
GMAIL_USER = "naneja@gmail.com"

#set using https://myaccount.google.com/apppasswords
GMAIL_PASSWORD = "your-password-or-app-password"

# Email details
TO_EMAIL = "naneja@gmail.com"

SUBJECT = "Test Email from Python"

BODY = """Hello,

This is a test email sent using Python!


Best regards,
Your Python Script"""

def send_email():
  try:
    # Set up the email message
    msg = MIMEMultipart()
    msg["From"] = GMAIL_USER
    msg["To"] = TO_EMAIL
    msg["Subject"] = SUBJECT
    msg.attach(MIMEText(BODY, "plain"))

    # Connect to Gmail's SMTP server
    server = smtplib.SMTP("smtp.gmail.com", 587)
    server.starttls()  # Secure the connection
    server.login(GMAIL_USER, GMAIL_PASSWORD)  # Login to Gmail
    server.sendmail(GMAIL_USER, TO_EMAIL, msg.as_string())  # Send the email
    server.quit()  # Close the connection
    print("Email sent successfully!")
  except Exception as e:
    print(f"Error: {e}")

# Send the email
send_email()