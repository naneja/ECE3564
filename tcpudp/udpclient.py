#UDP Client: udpclient.py
from socket import *

# get message from user
message = input("Input lowercase sentence: ")

encoded_message = message.encode()

print(encoded_message, " ", list(encoded_message)) 

# Create clientSocket
# AF_INET for IPv4 # SOCK_DGRAM is for UDP socket
clientSocket = socket(AF_INET, SOCK_DGRAM)
# (0.0.0.0, 0)

destination_address = ("161.35.59.112", 12000) #actual server IP Address

clientSocket.sendto(encoded_message, destination_address)

#buffer size 2048
modifiedMessage, serverAddress = clientSocket.recvfrom(2048)

print(modifiedMessage.decode())

clientSocket.close()