import React, { Component } from 'react';
import { Button, Modal, ModalHeader, ModalBody } from 'reactstrap';
import PacketForm from '../form/PacketForm.jsx';

class PacketModal extends Component {
    constructor(props) {
        super(props)
        this.state ={ 
            modal: false
        }
    }

    toggle = () => {
        this.setState(prevState => ({
            modal: !prevState.modal
        }))
    }

    render() {
        const closeBtn = <button className="close" onClick={this.toggle}>&times;</button>

        const label = this.props.buttonLabel

        let button = ''
        let title = ''

        if(label === 'Edit') {
            button = <Button 
                        color="warning" 
                        onClick={this.toggle} 
                        style={{float: "left", marginRight: "10px"}}>
                        {label}
                    </Button>
            title = 'Edit Packet'
        } else {
            button = <Button 
                        color="success" 
                        onClick={this.toggle} 
                        style={{float: "left", marginRight: "10px"}}>
                        {label}
                    </Button>
            title = 'Add New Packet'
        }


        return (
            <div>
                {button}
                <Modal isOpen={this.state.modal} toggle={this.toggle} className={this.props.className}>
                    <ModalHeader toggle={this.toggle} close={closeBtn}>{title}</ModalHeader>
                    <ModalBody>
                        <PacketForm 
                            addPacketToState={this.props.addPacketToState}
                            updateState={this.props.updateState}
                            toggle={this.toggle}
                            packet={this.props.packet}
                        />
                    </ModalBody>
                </Modal>
            </div>
        );
    }
}

export default PacketModal;