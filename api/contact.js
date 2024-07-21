// api/contact.js

const fs = require('fs');
const path = require('path');

module.exports = async (req, res) => {
  if (req.method === 'POST') {
    const { name, email, subject, message } = req.body;

    const newEntry = `
## New Contact Form Submission

- **Name:** ${name}
- **Email:** ${email}
- **Subject:** ${subject}
- **Message:** ${message}
    `;

    const filePath = path.join(__dirname, '../../messages.md');

    fs.appendFile(filePath, newEntry, (err) => {
      if (err) {
        return res.status(500).json({ status: 'error', message: 'Error writing to file.' });
      }
      res.status(200).json({ status: 'success', message: 'Your message has been saved.' });
    });
  } else {
    res.setHeader('Allow', ['POST']);
    res.status(405).end(`Method ${req.method} Not Allowed`);
  }
};
